<?php

namespace Database\Seeders;

use App\Models\Comment\CommentStatus;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommentStatus::create([
            'id' => 1 ,
            'title' => 'بررسی نشده'
        ]);
        CommentStatus::create([
            'id' => 2 ,
            'title' => 'تایید'
        ]);
        CommentStatus::create([
            'id' => 3 ,
            'title' => 'عدم تایید'
        ]);
    }
}
