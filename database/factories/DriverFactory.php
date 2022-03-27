<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'no_ktp' => $this->faker->randomNumber(20, true),
            'no_sim' => $this->faker->randomNumber(20, true),
            'handphone' => $this->faker->e164PhoneNumber()
        ];
    }
}
