<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MechanicSeeder extends Seeder
{
    /**
     * Assign mechanic role to Endra Maulana.
     */
    public function run(): void
    {
        $email = 'endramaulanapradipta' . '@' . 'gmail.com';

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update(['role' => 'mechanic']);
            $this->command->info("Updated: {$user->name} → mechanic");
        } else {
            User::create([
                'name' => 'Endra Maulana Pradipta',
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'mechanic',
                'profile_completed' => true,
            ]);
            $this->command->info('Created new mechanic account: ' . $email);
        }
    }
}
