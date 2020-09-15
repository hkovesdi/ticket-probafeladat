<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Ticket;

class TicketController extends Controller
{   

    public function index(\App\Http\Requests\SortTickets $request)
    {      
        $sortBy = $request->query('sort-by', 'created_at');
        $orderBy = $request->query('order-by', 'asc');
        $perPage = $request->query('per-page', 15);

        $tickets = Ticket::with('customer')
            ->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
        
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
