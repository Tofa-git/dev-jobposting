<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        	MasterDataSeeder::class,
        	MasterDataDetailSeeder::class,
        	DefaultUserSeeder::class,
            AppPropertiesSeeder::class,
        	FrontendMenuSeeder::class,
        	BackendMenuSeeder::class,
        	GroupRoleSeeder::class,
        	UserRoleSeeder::class,
            DataWilayahSeeder::class,
            WidgetSeeder::class,
        ]);
    }
}
