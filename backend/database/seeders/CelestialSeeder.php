<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Celestial;

class CelestialSeeder extends Seeder
{
    public function run()
    {
        Celestial::create([
            'name' => 'Earth',
            'type' => 'Planet',
            'description' => 'Our home planet.',
            'image' => 'earth.jpg',
            'pitch' => 0.0,
            'yaw' => 0.0,
        ]);

        Celestial::create([
            'name' => 'Sun',
            'type' => 'Star',
            'description' => 'The star at the center of our solar system.',
            'image' => 'sun.jpg',
            'pitch' => 0.0,
            'yaw' => 0.0,
        ]);

        Celestial::create([
            'name' => 'Moon',
            'type' => 'Moon',
            'description' => 'Earth\'s only natural satellite.',
            'image' => 'moon.jpg',
            'pitch' => 0.0,
            'yaw' => 0.0,
        ]);
    }
}
