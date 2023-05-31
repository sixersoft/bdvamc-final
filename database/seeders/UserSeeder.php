<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@gmail.com')->first();
        if (is_null($user)) {
            $user = new User();
            $user->name = "Super Admin";
            $user->email = "admin@gmail.com";
            $user->password = Hash::make('18507989');
            $user->save();
        }
    }
}
