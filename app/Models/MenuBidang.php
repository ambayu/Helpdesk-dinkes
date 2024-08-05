<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuBidang extends Model
{
  use HasFactory;

  protected $table = 'menu_bidang';

  protected $fillable = ['id_menu', 'id_pidang'];

  public function menu()
  {
    return $this->belongsTo(Menu::class, 'id_menu', 'id');
  }
  public function bidang()
  {
    return $this->belongsTo(Bidang::class, 'id_bidang', 'id');
  }
}
