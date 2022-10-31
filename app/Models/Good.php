<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'title', 'price', 'price_sp', 'quantity', 'group_buy', 'main_page', 'desc'];

    public function folder() {
        return $this->belongsTo(\App\Models\Folder::class);
    }

    public function file() {
        return $this->belongsTo(\App\Models\File::class);
    }

    public function unit() {
        return $this->belongsTo(\App\Models\Unit::class);
    }

    public function properties() {
        return $this->belongsToMany(\App\Models\Property::class, 'property_binds');
    }

    protected function quantity(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => number_format($value * 1, 3, '.', ''),
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => number_format($value * 1, 2, '.', ''),
        );
    }

    protected function priceSp(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => number_format($value * 1, 2, '.', ''),
        );
    }
}
