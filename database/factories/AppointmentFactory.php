<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Role;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => User::factory()->create([
                'role_id' => Role::where('name', 'patient')->first()->id
            ])->id,
            'doctor_id' => User::factory()->create([
                'role_id' => Role::where('name', 'doctor')->first()->id
            ])->id,
            'contact' => $this->faker->numberBetween(0, 1),
            'details' => $this->faker->text,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected'])
        ];
    }
}
