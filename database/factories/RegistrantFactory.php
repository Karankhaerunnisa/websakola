<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Enums\RegistrantStatus;
use App\Enums\Religion;
use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registrant>
 */
class RegistrantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Pick a random existing Major
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'major_id' => Major::inRandomOrder()->first()->id ?? Major::factory(),

            'registration_number' => 'REG-' . $this->faker->unique()->numerify('##########'),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'nik' => $this->faker->unique()->numerify('################'),
            'birth_place' => $this->faker->city(),
            'birth_date' => $this->faker->date('Y-m-d', '-15 years'), // Approx high school age
            'gender' => $this->faker->randomElement(Gender::cases()),
            'religion' => $this->faker->randomElement(Religion::cases()),
            'status' => $this->faker->randomElement(RegistrantStatus::cases()),
        ];
    }
}
