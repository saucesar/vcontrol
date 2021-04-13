<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CompanySeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            EmailSeeder::class,
            CategoryEmailSeeder::class,
            ReasonSeeder::class,
            DateSeeder::class,
        ]);
    }
}
