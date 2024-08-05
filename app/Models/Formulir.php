<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formulir extends Model
{
  use HasFactory, SoftDeletes;
  protected $table = 'formulir_layanan';

  protected $fillable = [
    'id_menu',
    'formulir',
    'type_formulir',
    'id_user',
  ];
  protected $dates = ['deleted_at'];

  public function menu()
  {
    return $this->belongsTo(Menu::class, 'id_menu', 'id');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'id_user', 'id');
  }
  public function inputan()
  {
    return $this->belongsTo(Inputan::class, 'type_formulir', 'id');
  }

  public function formulir()
  {
    return $this->formulir['id_formulir'] ?? null;
  }
}
