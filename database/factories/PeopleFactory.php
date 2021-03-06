<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->name,
            'lastname' => $this->faker->name,
            'birthdate' => $this->faker->dateTime(),
            'address' => $this->faker->address,
            'zip' => $this->faker->postCode,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'country_id' => Country::find('id')


        ];
    }
}
