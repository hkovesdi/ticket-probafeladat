<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('tickets');
    }

    public function create() 
    {
        return view('create-ticket');
    }
}
