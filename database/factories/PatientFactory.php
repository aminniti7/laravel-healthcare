<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Il nome del modello associato a questa factory.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Definisce lo stato predefinito del modello.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'birth_date' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'national_id' => $this->faker->unique()->numerify('##########'),
        ];
    }
}