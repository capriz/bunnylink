<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Breed;
use App\Models\Rabbit;
use App\Models\RabbitStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class RabbitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rabbit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = ['local', 'pure', 'f1', 'f2', 'f3', 'hybrid', 'upgraded'];

        return [
            'org_id'      => 1,
            'tag_id'      => null,
            'breeding_id' => null,
            'cage_no'     => $this->faker->numberBetween(1, 100),
            'category'    => $this->faker->randomElement($category),
            'breed'       => Breed::inRandomOrder()->first()->name,
            'type'        => $this->faker->randomElement(['meat', 'pet']),
            'color'       => $this->faker->colorName(),
            'dob'         => $this->faker->dateTimeBetween('-1 year', 'now'),
            'gender'      => $this->faker->randomElement(['doe', 'buck', 'unknown',]),
            'status'      => RabbitStatus::inRandomOrder()->first()->name,
            'home_breed'  => $this->faker->randomElement([0, 1, 'unknown']),
            'notes'       => 'Seeder',
            'inserted_by' => User::inRandomOrder()->first()->name,
            'updated_by'  => '',
        ];
    }
}
