<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create users with the corresponding role IDs
        User::create([
            'firstname' => 'Super',
            'secondname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
            'gender' => 'Male',
            'status' => 'active',
            'can_manage_all_schools' => true,
        ]);

   
    }
}
