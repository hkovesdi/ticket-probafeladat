<?php

return [
    'login' => [
        'username' => 'Username',
        'password' => 'Password',
        'submit' => 'Login',
        'success' => 'Successfully logged in',
        'error' => 'Wrong username or password'
    ],
    'logout' => [
        'success' => 'Succesfully logged out'
    ],
    'menu' => [
        'title' => 'Ticket system',
        'login' => 'Login',
        'logout' => 'Logout',
        'newTicket' => 'Submit new ticket',
        'tickets' => 'Tickets',
        'customers' => 'Customers',
        'sortOptions' => 'Sort options'
    ],
    'tickets' => [
        'create' => [
            'form' => [
                'name' => 'Submit new ticket',
                'inputs' => [
                    'name' => 'Name',
                    'email' => 'Email',
                    'title' => 'Title',
                    'content' => 'Content',
                    'submit' => 'Submit'
                ]
            ],
            'success' => 'Ticket successfully submitted'
        ],
        'sortOptions' => [
            'sortBy' => [
                'name' => 'Sort by',
                'dueDate' => 'Due date',
                'createdAt' => 'Submit date'
            ],
            'orderBy' => [
                'name' => 'Order by',
                'asc' => 'Ascending (old first)',
                'desc' => 'Descending (new first)'
            ],
            'perPage' => [
                'name' => 'Maximum number of items per page',
            ],
            'sort' => 'Sort'
        ],
        'submitter' => 'Submitter',
        'due' => 'Due',
        'submitted' => 'Submitted at'
    ],
    'customers' => [
        'email' => 'Email',
        'name' => 'Name',
        'tickets' => 'Submitted tickets'
    ]
];