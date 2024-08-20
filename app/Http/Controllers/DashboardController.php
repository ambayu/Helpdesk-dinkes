<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\News;
use App\Models\Answer;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  //
  public function index()
  {
    // $tickets = Ticket::where('id_user', auth()->user()->id)->get();
    // $ticketCounts = [
    //   'pending' => $tickets->where('status', 3)->count(),
    //   'proses' => $tickets->whereBetween('status', [4, 7])->count(),
    //   'finish' => $tickets->where('status', '>', 7)->count(),
    //   'total' => $tickets->count(),
    // ];
    $total_tiket = Ticket::count();

    $user = Auth::user();
    $user->load('roleBidang.bidang.menuBidang', 'roles');
    $menu = Menu::all();

    $role = $user->roles[0]->name;

    $menuBidangIds = $user->roleBidang ? $user->roleBidang->bidang->menuBidang->pluck('id_menu')->toArray() : '';

    $countSelesai = Answer::filteredAnswers($user, $role, $menuBidangIds)
      ->where('status_answer', '>', 7)
      ->count();

    $countOnProses = Answer::filteredAnswers($user, $role, $menuBidangIds)
      ->whereBetween('status_answer', [4, 7])
      ->count();

    $countPending = Answer::filteredAnswers($user, $role, $menuBidangIds)
      ->where('status_answer', 0)
      ->count();
    $today = Carbon::today();
    // Menghitung jumlah jawaban yang dibuat hari ini
    $answersToday = Answer::whereDate('created_at', $today)->count();

    // Menghitung total jawaban
    $totalAnswers = Answer::count();

    // Menghitung persentase jawaban yang dibuat hari ini dibandingkan dengan total
    $percentage = ($totalAnswers > 0) ? ($answersToday / $totalAnswers) * 100 : 0;

    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    // Menghitung jumlah jawaban yang dibuat bulan ini
    $answersThisMonth = Answer::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

    // Menghitung total jawaban
    $totalAnswers = Answer::count();

    // Menghitung persentase jawaban yang dibuat bulan ini dibandingkan dengan total
    $percentage_mount = ($totalAnswers > 0) ? ($answersThisMonth / $totalAnswers) * 100 : 0;

    $ticketCounts = [
      'pending' => $countPending,
      'proses' => $countOnProses,
      'finish' => $countSelesai,
      'total' => $countPending + $countOnProses + $countSelesai,
      'todaypersen' => round($percentage, 2),
      'total_bulan_ini' => $answersThisMonth,
      'total_persen_bulan_ini' => round($percentage_mount, 2),
      'today' => $answersToday,

    ];
    $news = News::orderBy('created_at', 'desc')->first();
    return view('content.apps.app-dashboard', compact('ticketCounts', 'total_tiket', 'news'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'judul' => 'required|string|max:255',
      'link' => 'required|url',
      'deskripsi' => 'required|string',
      'tanggal' => 'required|date',
      'durasi' => 'required|string',
      'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
    ]);

    $photoPath = null;
    if ($request->hasFile('photo')) {
      $photoPath = $request->file('photo')->store('photos', 'public');
    }

    // Buat berita baru
    News::create([
      'judul' => $validatedData['judul'],
      'deskripsi' => $validatedData['deskripsi'],
      'link' => $validatedData['link'],
      'tanggal' => $validatedData['tanggal'],
      'durasi' => $validatedData['durasi'],
      'foto' => $photoPath,
    ]);
    return redirect()->route('dashboard')->with('success', 'Kabar berhasil diperbaharui .');
  }
}
