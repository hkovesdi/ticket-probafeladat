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

    public function store(Request $request) 
    {

    }
}
