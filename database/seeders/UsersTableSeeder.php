<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            User::factory()->create(['user_name' => '山田一郎', 'email' => 'Yamada@example.com', 'password' => Hash::make('321DoubleB')]),
            User::factory()->create(['user_name' => '鈴木花子', 'email' => 'hanako@example.com', 'password' => Hash::make('furima875')]),
            User::factory()->create(['user_name' => '瓜田杉郎', 'email' => 'uritai@example.com', 'password' => Hash::make('100items')]),
        ]);

        collect($users)->each(function ($user){
            Profile::factory()->count(1)->for($user)->create();
        });


    }
}
