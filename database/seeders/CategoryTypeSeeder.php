<?php

namespace Database\Seeders;

use App\Models\Category\CategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryType::create([
            'id' => 1 ,
            'title'=> 'اخبار'
        ]);
    }
}
