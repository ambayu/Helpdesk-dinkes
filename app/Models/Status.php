<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

  use HasFactory;
  protected $table = 'status';


  public function ticket()
  {
    return $this->hasMany(Ticket::class, 'id', 'status');
  }
}
