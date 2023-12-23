<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function key() {
      return $this->belongsTo(Characteristic_values::class);
    }
}
