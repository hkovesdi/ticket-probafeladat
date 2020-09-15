<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index() 
    {   
        $customers = Customer::orderBy('created_at', 'desc')->paginate(15);
        return view('customers', ['customers' => $customers]);
    }

    public function tickets(Customer $customer)
    {
        return view('tickets', ['tickets' => $customer->tickets()->paginate(15)]);
    }
}
