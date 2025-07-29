<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run() : void
    {
        User::factory()->create([
            'name' => 'Carlos Santos',
            'email' => 'carlos.santos.dev@gmail.com',
            'github_login' => 'carlossantosdev',
        ]);

        User::factory(10)->create();
    }
}
