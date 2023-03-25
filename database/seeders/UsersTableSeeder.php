<?php
namespace Database\Seeders;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\User::create([
                'name' => 'Cesar',
                'email' => 'cesar@vc.com',
                'type' =>'owner',
                'password' => bcrypt('123456'),
                'company_id' => 1,
            ]);
        
            DB::table('users')->insert([
                'name' => 'Admin Admin',
                'email' => 'admin@argon.com',
                'type' =>'owner',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch(Exception $e) {}

        \App\Models\User::factory()->times(10)->create();
    }
}