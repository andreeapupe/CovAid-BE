<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RealAppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patientRole = Role::where('name', 'patient')->first();
        $doctorRole = Role::where('name', 'doctor')->first();

        // Create doctors
        $doctorOne = User::factory()->create(['role_id' => $doctorRole->id]);
        $doctorTwo = User::factory()->create(['role_id' => $doctorRole->id]);

        // Create patients
        $patientOne = User::factory()->create(['role_id' => $patientRole->id]);
        $patientTwo = User::factory()->create(['role_id' => $patientRole->id]);

        // Create appointments
        $appointments = Appointment::factory()->count(5)->create([
            'patient_id' => User::where('email', 'andreeapupe@yahoo.com')->first()->id
        ]);
    }
}
