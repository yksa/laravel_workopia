<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ye Kyaw Swar Aung',
            'email' => 'yekyawswaraung@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        return $user;
    }
}
