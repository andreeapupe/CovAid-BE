<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Andreea Pupe',
            'email' => 'andreeapupe@yahoo.com',
            'password' => bcrypt('secret')
        ]);
    }
}
