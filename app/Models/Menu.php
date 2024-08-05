<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'menu';

  protected $fillable = [
    'nama_layanan',
    'slug',
    'id_user',

  ];

  protected $dates = ['deleted_at'];


  public function formulir()
  {
    return $this->hasMany(Formulir::class, 'id_menu', 'id');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'id_user', 'id');
  }
  public function  menuBidang()
  {
    return $this->hasMany(MenuBidang::class, 'id_menu', 'id');
  }

  public function  syarat()
  {
    return $this->belongsTo(Syarat::class, 'id', 'id_menu');
  }
}
