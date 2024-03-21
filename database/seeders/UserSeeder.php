<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->firstOrCreate([
            'email' => 'bob@mail.com',
        ], [
            'name' => 'Bob',
            'password' => 'bob123',
        ]);

        User::query()->firstOrCreate([
            'email' => 'jhon@mail.com',
        ], [
            'name' => 'Jhon',
            'password' => 'jhon123',
        ]);
    }
}
