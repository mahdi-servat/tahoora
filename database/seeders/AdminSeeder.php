<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'mmwdali',
            'last_name' => 'hosseini',
            'email' => 'ali13hosseiny81@gmail.com',
            'phone' => '989128524065',
            'password' => Hash::make('Ma061016')
        ]);

        $user->assignRole('admin');

    }
}
