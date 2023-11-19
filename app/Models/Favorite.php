<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
  protected $fillable = [
    'photo_id',
    'photo_url',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
