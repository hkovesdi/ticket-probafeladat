<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Ticket;
use Illuminate\Support\Facades\Lang;

class TicketController extends Controller
{   

    /**
     * Show the tickets page
     * @param \App\Http\Requests\SortTickets $request
     * @return View
     */
    public function index(\App\Http\Requests\SortTickets $request)
    {      
        $sortBy = $request->query('sort-by', 'created_at');
        $orderBy = $request->query('order-by', 'desc');
        $perPage = $request->query('per-page', 15);

        $tickets = Ticket::with('customer')
            ->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
        
        return view('tickets', ['tickets' => $tickets]);
    }

    /**
     * Show the ticket creation page
     * @return View
     */
    public function create() 
    {
        return view('create-ticket');
    }

    /**
     * Store a new ticket, and attach it to the customer if exists
     * or create new if not
     * @param \App\Http\Requests\StoreTicket $request
     * @return RedirectResponse
     */
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

        return redirect()->back()->withSuccess(Lang::get('messages.tickets.create.success'));
    }
}
