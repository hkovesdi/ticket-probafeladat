<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Customer;
use \App\Models\Ticket;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        //Password is: password
        User::factory()->create([
            'username' => 'admin',
        ]);
        Customer::factory()
        ->count(18)
        ->has(
            Ticket::factory()
            ->count(random_int(1, 8))
        )
        ->create();
    }
}
