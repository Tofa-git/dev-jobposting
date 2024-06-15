<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	User::insert([
            'name'				=> 'Developer',
            'email'				=> 'developer@link-webid.com',
            'email_verified_at'	=> now(),
            'password'			=> Hash::make('Developer@2023'),
            'role'				=> 1,
            'status'			=> '0',
            'created_by'    	=> 1,
            'created_at'        => now(),
        ]);
    }
}
