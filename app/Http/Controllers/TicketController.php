<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Ticket;

class TicketController extends Controller
{   

    /**
     * Process the query string
     * @param array $options The possible values the $queryString can have
     * @param mixed $default The default value to be returned
     * @return mixed $queryString if it's in the $options array, $default otherwise
     */
    private function processQueryString(array $options, $default, $queryString) 
    {
        return in_array($queryString, $options) ? $queryString : $default;
    }

    public function index(Request $request)
    {      
        $sortBy = $this->processQueryString(
            array('created_at', 'due_date'), 
            'created_at', 
            $request->query('sort-by', null)
        );
        $orderBy = $this->processQueryString(
            array('asc', 'desc'), 
            'asc', 
            $request->query('order-by', null)
        );
        $perPage = $this->processQueryString(
            array(5, 10, 15), 
            15, 
            $request->query('per-page', null)
        );

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
