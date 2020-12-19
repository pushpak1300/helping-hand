<?php

namespace Database\Factories;

use App\Models\Receiver;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceiverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Receiver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'age' => $this->faker->randomDigitNotNull,
        'created_by' => $this->faker->randomDigitNotNull,
        'user_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
