<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'id' => 1 ,
            'title' => 'فعال'
        ]);
        Status::create([
            'id' => 2 ,
            'title' => 'غیر فعال'
        ]);
    }
}
