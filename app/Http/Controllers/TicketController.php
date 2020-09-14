<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {   
        $tickets = Ticket::with('customer')->paginate(20);
        return view('tickets', ['tickets' => $tickets]);
    }

    public function create() 
    {
        return view('create-ticket');
    }

    public function store(\App\Http\Requests\StoreTicket $request) 
    {
        $data = $request->only(['name', 'email', 'title', 'content']);
        $customer = \App\Models\Customer::where('name', $data['name'])->where('email', $data['email'])->first();
        if ($customer === null) {
            $customer = \App\Models\Customer::create([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
        }

        $customer->tickets()->create([
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        return redirect()->back()->with('success', 'Hibajegy sikeresen létrehozva!');
    }
}
