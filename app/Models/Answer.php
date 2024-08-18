<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  use HasFactory;
  protected $casts = [
    'formulir' => 'json',
  ];

  public function ticket()
  {
    return $this->belongsTo(Ticket::class, 'id_ticket');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'id_user');
  }
  public function menu()
  {
    return $this->belongsTo(Menu::class, 'id_menu');
  }

  public function status()
  {
    return $this->belongsTo(Status::class, 'status_answer');
  }

  public function respon_answer()
  {
    return $this->hasMany(ResponAnswer::class, 'id_answer', 'id');
  }
  public function pindah_layanan()
  {
    return $this->belongsTo(PermintaanUbahBidang::class, 'id_pindah_layanan');
  }


  public function scopeFilteredAnswers($query, $user, $role, $menuBidangIds)
  {
    return $query->with([
      'ticket.user',
      'ticket.statuses',
      'status',
      'pindah_layanan.menu_baru',
      'menu' => function ($query) {
        $query->withTrashed();
      },
      'respon_answer.user.roles',
      'respon_answer.user.roleBidang.bidang',
      'menu.menuBidang.bidang'
    ])
      ->when($role == 'Admin Layanan', function ($query) use ($menuBidangIds) {
        return $query->where(function ($query) use ($menuBidangIds) {
          $query->whereHas('pindah_layanan', function ($query) use ($menuBidangIds) {
            $query->whereIn('id_menu_baru', $menuBidangIds);
          })
            ->orWhere(function ($query) use ($menuBidangIds) {
              $query->whereNull('id_pindah_layanan')
                ->whereIn('id_menu', $menuBidangIds);
            });
        });
      })
      ->when($role == 'User', function ($query) use ($user) {
        return $query->whereHas('ticket', function ($query) use ($user) {
          $query->where('id_user', $user->id);
        });
      });
  }
}
