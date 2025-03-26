<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('roles')->insert([
            [
                'nama' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'stafkeuangan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'manajer',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('users')->insert([
            [
                'role_id' => '1',
                'name' => 'Ajeng Fuji Rahayu',
                'email' => 'ajeng@gmail.com',
                'password' => bcrypt('ajeng123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'role_id' => '2',
                'name' => 'Irhas Wahyu Ningtyas',
                'email' => 'irhas@gmail.com',
                'password' => bcrypt('irhas123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => '3',
                'name' => 'Nafis Kurniatul Faizah',
                'email' => 'nafis@gmail.com',
                'password' => bcrypt('nafis123'),
                'created_at' => now(),
                'updated_at' => now()
            ]]);
    }
}
