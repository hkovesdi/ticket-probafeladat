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
        Customer::factory()->count(50)->hasTickets(3)->create();
    }
}
