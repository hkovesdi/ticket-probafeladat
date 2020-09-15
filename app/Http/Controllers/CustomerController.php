<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{   
    /**
     * Show the customers page
     * @return View
     */
    public function index() 
    {   
        $customers = Customer::orderBy('created_at', 'desc')->paginate(15);
        return view('customers', ['customers' => $customers]);
    }

    /**
     * Show the customer's tickets
     * @param Customer $customer
     * @param \App\Http\Requests\StoreTicket $request
     * @return View
     */
    public function tickets(Customer $customer, \App\Http\Requests\SortTickets $request)
    {   
        $sortBy = $request->query('sort-by', 'created_at');
        $orderBy = $request->query('order-by', 'desc');
        $perPage = $request->query('per-page', 6);

        return view('tickets', ['tickets' => $customer->tickets()->orderBy($sortBy, $orderBy)->paginate($perPage)]);
    }
}
