<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::table('users')->insert([
			'name' => 'admin',
			'email' => 'admin@admin.com',
            'password' => Hash::make('admin@123'),
            'role' => 'admin'
		]);
        DB::table('user_details')->insert([
			'full_name' => 'admin',
			'email' => 'admin@admin.com',
            'user_id' => 1
		]);
    }
}
