<?php

namespace App\Http\Controllers\apps;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\User;
use App\Models\Answer;
use App\Models\Bidang;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Formulir;
use App\Models\MenuBidang;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class CekPermintaanController extends Controller
{
  public function index()
  {
    $menu = Menu::all();
    $user = Auth::user();
    $user->load('roleBidang.bidang.menuBidang', 'roles');
    $role = $user->roles[0]->name;
    $menuBidangIds =  $user->roleBidang ?  $user->roleBidang->bidang->menuBidang->pluck('id_menu')->toArray() : '';

    $answers = Answer::filteredAnswers($user, $role, $menuBidangIds)
      ->orderBy('updated_at', 'DESC')
      ->paginate(10);

    // return $answers;

    $data = [];
    foreach ($answers as $answer) {

      $formulirData = [];

      foreach ($answer->formulir as $item) {

        $formulir = Formulir::find($item['id_formulir']);

        $formulir;
        // Jika formulir ditemukan, tambahkan ke $formulirData
        if ($formulir) {
          $formulirData[] = [
            'id_formulir' => $item['id_formulir'],
            'pertanyaan' => $formulir->formulir, // Asumsi formulir adalah nama kolom dalam model Formulir
            'type_formulir' => $formulir->type_formulir, // Asumsi formulir adalah nama kolom dalam model Formulir
            'respon' => $item['respon'],
          ];
        }
      }


      $data[] = [
        'id' => $answer->id,
        'judul' => $answer->judul,
        'layanan' => $answer->menu->nama_layanan,
        'bidang' => $answer->menu->menuBidang->pluck('bidang')->pluck('nama_bidang'),
        'menu' => $answer->menu,
        'tanggal_kirim' => $answer->tanggal_kirim,
        'nomor_tiket' => $answer->ticket->nomor_tiket,
        'status' => $answer->ticket->statuses,
        'nama' => $answer->ticket->user->name,
        'email' => $answer->ticket->user->email,
        'respon_answer' => $answer->respon_answer,
        'status_answer' => $answer->status,
        'id_status_answer' => $answer->status_answer,
        'pindah_layanan' => $answer->pindah_layanan,
        'file' => $answer->file,
        'user' => $answer->ticket->user,

        'formulir' => $formulirData,
        'deskripsi' => $answer->deskripsi,

      ];
      // return $data;
    }




    $dataObject = json_decode(json_encode($data), false);

    // return $dataObject[0]->respon_answer;

    return view('content.pages.pages-cek-permintaan', compact('dataObject', 'answers', 'role', 'menu'));
  }

  public function status($status)
  {
    $user = Auth::user();
    $user->load('roleBidang.bidang.menuBidang', 'roles');
    $menu = Menu::all();

    $role = $user->roles[0]->name;
    $menuBidangIds =  $user->roleBidang ?  $user->roleBidang->bidang->menuBidang->pluck('id_menu')->toArray() : '';
    $answers = Answer::filteredAnswers($user, $role, $menuBidangIds)

      ->when($status == 'selesai', function ($query) {
        return $query->where('status_answer', '>', 7);
      })
      ->when($status == 'on-proses', function ($query) {
        return $query->whereBetween('status_answer', [4, 7]);
      })
      ->when($status == 'pending', function ($query) {
        return $query->where('status_answer', 0);
      })
      ->orderBy('updated_at', 'DESC')
      ->paginate(10);



    $data = [];
    foreach ($answers as $answer) {
      $formulirData = [];

      foreach ($answer->formulir as $item) {
        // Cari formulir berdasarkan id_formulir
        $formulir = Formulir::find($item['id_formulir']);

        // Jika formulir ditemukan, tambahkan ke $formulirData
        if ($formulir) {
          $formulirData[] = [
            'id_formulir' => $item['id_formulir'],
            'pertanyaan' => $formulir->formulir, // Asumsi formulir adalah nama kolom dalam model Formulir
            'respon' => $item['respon'],
            'type_formulir' => $formulir->type_formulir, // Asumsi formulir adalah nama kolom dalam model Formulir

          ];
        }
      }

      $data[] = [
        'id' => $answer->id,
        'judul' => $answer->judul,
        'layanan' => $answer->menu->nama_layanan,
        'bidang' => $answer->menu->menuBidang->pluck('bidang')->pluck('nama_bidang'),
        'menu' => $answer->menu,
        'tanggal_kirim' => $answer->tanggal_kirim,
        'nomor_tiket' => $answer->ticket->nomor_tiket,
        'status' => $answer->ticket->statuses,
        'nama' => $answer->ticket->user->name,
        'email' => $answer->ticket->user->email,
        'respon_answer' => $answer->respon_answer,
        'status_answer' => $answer->status,
        'id_status_answer' => $answer->status_answer,
        'pindah_layanan' => $answer->pindah_layanan,
        'file' => $answer->file,
        'formulir' => $formulirData,
        'deskripsi' => $answer->deskripsi,

      ];
    }

    // return $data;

    $dataObject = json_decode(json_encode($data), false);


    return view('content.pages.pages-cek-permintaan', compact('dataObject', 'answers', 'role', 'menu'));
  }

  public function search(Request $request)
  {
    $menu = Menu::all();

    $user = Auth::user();
    $user->load('roleBidang.bidang.menuBidang', 'roles');
    $role = $user->roles[0]->name;
    $menuBidangIds =  $user->roleBidang ?  $user->roleBidang->bidang->menuBidang->pluck('id_menu')->toArray() : '';

    $query = Answer::filteredAnswers($user, $role, $menuBidangIds);

    $search = $request->search;


    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('judul', 'like', '%' . $search . '%')
          ->orWhereHas('ticket', function ($q) use ($search) {
            $q->where('nomor_tiket', 'like', '%' . $search . '%');
          });
      });
    }
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');

    if ($startDate && $endDate) {
      $startDate = Carbon::parse($startDate)->startOfDay();
      $endDate = Carbon::parse($endDate)->endOfDay();

      $query->whereBetween('tanggal_kirim', [$startDate, $endDate]);
    }

    $answers = $query->orderBy('updated_at', 'DESC')->paginate(10);
    $data = [];
    foreach ($answers as $answer) {
      $formulirData = [];

      foreach ($answer->formulir as $item) {
        // Cari formulir berdasarkan id_formulir
        $formulir = Formulir::find($item['id_formulir']);

        // Jika formulir ditemukan, tambahkan ke $formulirData
        if ($formulir) {
          $formulirData[] = [
            'id_formulir' => $item['id_formulir'],
            'pertanyaan' => $formulir->formulir, // Asumsi formulir adalah nama kolom dalam model Formulir
            'respon' => $item['respon'],
            'type_formulir' => $formulir->type_formulir, // Asumsi formulir adalah nama kolom dalam model Formulir

          ];
        }
      }


      $data[] = [
        'id' => $answer->id,
        'judul' => $answer->judul,
        'layanan' => $answer->menu->nama_layanan,
        'bidang' => $answer->menu->menuBidang->pluck('bidang')->pluck('nama_bidang'),
        'menu' => $answer->menu,
        'tanggal_kirim' => $answer->tanggal_kirim,
        'nomor_tiket' => $answer->ticket->nomor_tiket,
        'status' => $answer->ticket->statuses,
        'nama' => $answer->ticket->user->name,
        'email' => $answer->ticket->user->email,
        'respon_answer' => $answer->respon_answer,
        'status_answer' => $answer->status,
        'id_status_answer' => $answer->status_answer,
        'pindah_layanan' => $answer->pindah_layanan,
        'file' => $answer->file,
        'formulir' => $formulirData,
        'deskripsi' => $answer->deskripsi,

      ];
    }

    $dataObject = json_decode(json_encode($data), false);


    return view('content.pages.pages-cek-permintaan', compact('dataObject', 'answers', 'role', 'menu'));
  }


  public function cari($tiket)
  {
    $menu = Menu::all();

    $user = Auth::user();
    $user->load('roleBidang.bidang.menuBidang', 'roles');
    $role = $user->roles[0]->name;
    $menuBidangIds =  $user->roleBidang ?  $user->roleBidang->bidang->menuBidang->pluck('id_menu')->toArray() : '';

    $query = Answer::filteredAnswers($user, $role, $menuBidangIds);

    $search = $tiket;


    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('judul', 'like', '%' . $search . '%')
          ->orWhereHas('ticket', function ($q) use ($search) {
            $q->where('nomor_tiket', 'like', '%' . $search . '%');
          });
      });
    }



    $answers = $query->orderBy('updated_at', 'DESC')->paginate(10);
    $data = [];
    foreach ($answers as $answer) {
      $formulirData = [];

      foreach ($answer->formulir as $item) {
        // Cari formulir berdasarkan id_formulir
        $formulir = Formulir::find($item['id_formulir']);

        // Jika formulir ditemukan, tambahkan ke $formulirData
        if ($formulir) {
          $formulirData[] = [
            'id_formulir' => $item['id_formulir'],
            'pertanyaan' => $formulir->formulir, // Asumsi formulir adalah nama kolom dalam model Formulir
            'respon' => $item['respon'],
            'type_formulir' => $formulir->type_formulir, // Asumsi formulir adalah nama kolom dalam model Formulir

          ];
        }
      }


      $data[] = [
        'id' => $answer->id,
        'judul' => $answer->judul,
        'layanan' => $answer->menu->nama_layanan,
        'bidang' => $answer->menu->menuBidang->pluck('bidang')->pluck('nama_bidang'),
        'menu' => $answer->menu,
        'tanggal_kirim' => $answer->tanggal_kirim,
        'nomor_tiket' => $answer->ticket->nomor_tiket,
        'status' => $answer->ticket->statuses,
        'nama' => $answer->ticket->user->name,
        'email' => $answer->ticket->user->email,
        'respon_answer' => $answer->respon_answer,
        'status_answer' => $answer->status,
        'id_status_answer' => $answer->status_answer,
        'pindah_layanan' => $answer->pindah_layanan,
        'file' => $answer->file,
        'formulir' => $formulirData,
        'deskripsi' => $answer->deskripsi,

      ];
    }

    $dataObject = json_decode(json_encode($data), false);


    return view('content.pages.pages-cek-permintaan', compact('dataObject', 'answers', 'role', 'menu'));
  }


  public function answer($answer)
  {
    $answer = Answer::with('ticket.user')->where('id', $answer)->first();
    return $answer;
  }
}
