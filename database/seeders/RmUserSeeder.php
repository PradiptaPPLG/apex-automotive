<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RmUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'cicilteamdeveloper@gmail.com'],
            [
                'name' => 'Sales RM Admin',
                'role' => 'rm',
                'profile_completed' => true,
            ]
        );
    }
}
