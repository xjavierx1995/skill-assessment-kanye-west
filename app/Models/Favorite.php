<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  use HasFactory;

  protected $table = 'favorites';

  protected $fillable = ['quote', 'userId'];

  protected $hidden = [
    'password',
    'remember_token',
    'created_at',
    'updated_at',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'userId');
  }
}
