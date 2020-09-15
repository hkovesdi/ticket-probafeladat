<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->bs,
            'content' =>  $this->faker->realText(200),
            'customer_id' => Customer::factory(),
            'created_at' => \Carbon\Carbon::now()->subSeconds($this->faker->numberBetween(0, 5184000))
        ];
    }
}
