<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
  use HasFactory;

  public function statuses()
  {
    return $this->belongsTo(Status::class, 'status', 'id');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'id_user', 'id');
  }
  public function answer()
  {
    return $this->belongsTo(Answer::class, 'id', 'id_ticket');
  }
}
