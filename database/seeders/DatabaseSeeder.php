<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
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
        // User::factory(10)->create();

        Pharmacy::factory()->create([
            'name' => 'First Pharmacy',
            'email' => 'msa0back@gmail.com',
            'google_id' => '102736598776507148394',
            'code' => 'DefaultPharma01',
            'password' => bcrypt('securepassword'), // Set a known password
        ]);
    }
}
