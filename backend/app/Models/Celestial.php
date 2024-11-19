<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celestial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'image',
        'pitch',
        'yaw',
        'size'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($celestial) {
            $celestial->pitch = mt_rand(0,90);
            $celestial->yaw = mt_rand(-180, 180);
            $celestial->size = mt_rand(5, 55);
            $celestial->image = 'planeet' . mt_rand(1, 15) . '.png';
        });
    }

}
