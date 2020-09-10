<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Customer;
use \App\Models\Ticket;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->hasTickets(3)->create();
    }
}
