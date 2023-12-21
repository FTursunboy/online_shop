<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic_values extends Model
{
    use HasFactory;

    protected $guarded = false;


    public function good() {
      return $this->belongsTo(Good::class);
    }

    public function characteristics() {
      return $this->belongsTo(Characteristic::class, 'characteristics_id');
    }
}
