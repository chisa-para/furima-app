<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'post_code' => $this->faker->postcode,
            'address' => $this->faker->prefecture() .
                        $this->faker->city() .
                        $this->faker->streetName() .
                        $this->faker->buildingNumber(),
            'building' => $this->faker->secondaryAddress,
        ];
    }
}
