<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function goods() {
        return $this->belongsToMany(\App\Models\Good::class, 'property_binds');
    }
}
