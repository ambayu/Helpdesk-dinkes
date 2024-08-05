<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanUbahBidang extends Model
{
  use HasFactory;
  protected $table = 'permintaan_ubah_bidang';

  public function user()
  {
    return $this->belongsTo(User::class, 'id_user');
  }
  public function menu_lama()
  {
    return $this->belongsTo(Menu::class, 'id_menu_lama');
  }
  public function answer()
  {
    return $this->belongsTo(Answer::class, 'id_answer');
  }
  public function menu_baru()
  {
    return $this->belongsTo(Menu::class, 'id_menu_baru');
  }
  public function menu_rekomend()
  {
    return $this->belongsTo(Menu::class, 'id_rekomend_menu');
  }
  public function user_validasi()
  {
    return $this->belongsTo(user::class, 'id_user_validasi');
  }
}
