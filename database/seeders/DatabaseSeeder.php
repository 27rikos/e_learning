<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'hp' => '081234567788',
            'password' => bcrypt('admin1234'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Cahya Wiguna',
            'email' => 'cahya@gmail.com',
            'hp' => '081234567788',
            'password' => bcrypt('cahya1234'),
            'role' => 'guru',
        ]);
        User::create([
            'name' => 'budi cahya',
            'email' => 'budi@gmail.com',
            'hp' => '081234567788',
            'password' => bcrypt('budi1234'),
            'role' => 'siswa',
        ]);
    }
}