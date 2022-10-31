<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'parent'];

    public function goods() {
        return $this->hasMany(\App\Models\Good::class);
    }

    public function children() {
        return $this->hasMany(static::class, 'parent');
    }
}
