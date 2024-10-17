<?php

namespace Database\Seeders;

use App\Models\Slider\SliderTypes;
use Illuminate\Database\Seeder;

class SliderTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['full-width', 'half-width'];
        foreach ($types as $type)
            SliderTypes::create(['title' => $type]);

    }
}
