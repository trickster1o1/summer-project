<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
