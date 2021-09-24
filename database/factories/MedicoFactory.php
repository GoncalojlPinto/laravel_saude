<?php

namespace Database\Factories;

use App\Models\Medico;
use Faker\Provider\pt_PT\Address;
use Faker\Provider\pt_PT\Person;
use Faker\Provider\pt_PT\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medico::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new Person($this->faker));
        $this->faker->addProvider(new Address($this->faker));
        $this->faker->addProvider(new PhoneNumber($this->faker));

        return [
            "name" => $this->faker->name(),
            "address" => $this->faker->address(),
            "phone" => $this->faker->phoneNumber(),
            "specialty_id" => 12
        ];
    }
}
