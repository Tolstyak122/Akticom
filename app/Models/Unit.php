<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function goods() {
        return $this->hasMany(\App\Models\Good::class);
    }
}
