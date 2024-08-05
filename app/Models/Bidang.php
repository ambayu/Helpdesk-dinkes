<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bidang extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'bidang';
  protected $fillable = [
    'bidang',

  ];

  public function menuBidang()
  {
    return $this->hasMany(MenuBidang::class, 'id_bidang', 'id');
  }
}
