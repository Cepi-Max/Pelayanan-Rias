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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Operator Desa',
            'username' => 'operator',
            'email' => 'operator@example.com',
            'role' => 'operator',
        ]);

        User::factory()->create([
            'name' => 'Warga Satu',
            'username' => 'warga1',
            'email' => 'warga1@example.com',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Warga Dua',
            'username' => 'warga2',
            'email' => 'warga2@example.com',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Warga Tiga',
            'username' => 'warga3',
            'email' => 'warga3@example.com',
            'role' => 'user',
        ]);

        $this->call([
            JenisSuratSeeder::class,
        ]);
    }
}
