<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'photo' => 'default.png',
            'user_name' => 'admin',
            'name' => 'Admin Name',
            'phone' => 01737111111,
            'nid' => 5682365656566,
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'role' => 1,
            'reffer_by' => 1,
        ]);
    }
}
