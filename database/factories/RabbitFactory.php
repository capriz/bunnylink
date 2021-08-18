<?php

namespace Database\Factories;

use App\Models\Rabbit;
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
        $status   = ['breeder', 'kits', 'grow outs', 'sold', 'culled', 'died', 'for sale', 'retired', 'donated',];
        $category = ['local', 'pure', 'f1', 'f2', 'f3', 'hybrid', 'upgraded'];

        return [
            'org_id'      => 1,
            'tag_id'      => null,
            'breeding_id' => null,
            'cage_no'     => null,
            'category'    => $this->faker->randomElement($category),
            'breed'       => $this->faker->randomElement(['amercan', 'angora', 'beige']),
            'type'        => $this->faker->randomElement(['meat', 'pet']),
            'color'       => $this->faker->colorName(),
            'dob'         => $this->faker->dateTimeBetween('-1 year', 'now'),
            'gender'      => $this->faker->randomElement(['doe', 'buck', 'unknown',]),
            'status'      => $this->faker->randomElement($status),
            'home_breed'  => $this->faker->randomElement([0, 1, 'unknown']),
            'litter_id'   => null,
            'notes'       => 'Seeder',
            'inserted_by' => 1,
            'updated_by'  => 1,
        ];
    }
}
