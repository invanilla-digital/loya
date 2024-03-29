<?php

return [
    [
        'title' => 'Top Navigation',
        'roles' => [
            'ROLE_USER'
        ],
        'items' => [
            [
                'title' => 'Dashboard',
                'route' => 'app_dashboard'
            ],
            [
                'title' => 'Campaigns',
                'route' => 'campaigns_index'
            ],
            [
                'title' => 'Customers',
                'route' => 'customers_index'
            ],
            [
                'title' => 'Settings',
                'route' => 'app_dashboard'
            ],
        ]
    ]
];