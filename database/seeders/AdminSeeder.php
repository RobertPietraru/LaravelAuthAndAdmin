<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@pietrocka.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
