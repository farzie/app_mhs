<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LoginAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('login_admin')->insert([
            'username' => 'admin',
            'password' => '$2y$12$7JCIj5RZoG9/zvgMq4tu/ubvwHyQemIPb9fznwj3RBxEgXdXxstH6', 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}