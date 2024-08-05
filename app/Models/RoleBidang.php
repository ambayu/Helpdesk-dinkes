<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleBidang extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'role_bidang';

  protected $fillable = [
    'id_bidang',
    'id_user',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'id_user');
  }

  public function bidang()
  {
    return $this->belongsTo(Bidang::class, 'id_bidang');
  }
}
