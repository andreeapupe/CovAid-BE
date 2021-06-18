<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $andreea = User::factory()->create([
            'name' => 'Andreea Pupe',
            'email' => 'andreeapupe@yahoo.com',
            'password' => bcrypt('secret'),
            'role_id' => Role::where('name', 'patient')->first()->id
        ]);

        $john = User::factory()->create([
            'name' => 'Doctor 1',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => Role::where('name', 'doctor')->first()->id
        ]);

        $user = User::factory()->count(10)->create();
    }
}
