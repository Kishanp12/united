<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'license' => 'licenses/8YFfvDIUrjXkTOnlafF8Cd3Ef1mVS3WRckAD8Fzw.txt',
            'approved' => false
        ];
    }
}
