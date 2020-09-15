<?php

return [
    'login' => [
        'username' => 'Felhasználónév',
        'password' => 'Jelszó',
        'submit' => 'Bejelentkezés',
        'success' => 'Sikeresen bejelentkezve',
        'error' => 'Rossz felhasználónév vagy jelszó'
    ],
    'logout' => [
        'success' => 'Sikeresen kijelentkezve'
    ],
    'menu' => [
        'title' => 'Ticket rendszer',
        'login' => 'Bejelentkezés',
        'logout' => 'Kijelentkezés',
        'newTicket' => 'Új hibajegy beküldése',
        'tickets' => 'Hibajegyek',
        'customers' => 'Ügyfelek',
        'sortOptions' => 'Rendezési beállítások'
    ],
    'tickets' => [
        'create' => [
            'form' => [
                'name' => 'Új hibajegy beküldése',
                'inputs' => [
                    'name' => 'Név',
                    'email' => 'Email',
                    'title' => 'Tárgy',
                    'content' => 'Tartalom',
                    'submit' => 'Beküldés'
                ]
            ],
            'success' => 'Hibajegy sikeresen beküldve'
        ],
        'sortOptions' => [
            'sortBy' => [
                'name' => 'Rendezés',
                'dueDate' => 'Esedékességi dátum alapján',
                'createdAt' => 'Beküldési dátum alapján'
            ],
            'orderBy' => [
                'name' => 'Rendezés módja',
                'asc' => 'Növekvő (régiek előre)',
                'desc' => 'Csökkenő (újak előre)'
            ],
            'perPage' => [
                'name' => 'Maximum találatok egy oldalon',
            ],
            'sort' => 'Rendezés'
        ],
        'submitter' => 'Beküldő',
        'due' => 'Esedékes',
        'submitted' => 'Beküldve'
    ],
    'customers' => [
        'email' => 'Email',
        'name' => 'Név',
        'tickets' => 'Beküldött hibajegyek'
    ],
];