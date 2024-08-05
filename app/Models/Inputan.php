<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inputan extends Model
{
  use HasFactory;
  protected $table = 'input_type';

  protected $fillable = [

    'nama_type',
  ];
}
