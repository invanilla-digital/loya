<?php

return [
    [
        'title' => 'General',
        'roles' => [
            'ROLE_USER'
        ],
        'items' => [
            [
                'title' => 'Dashboard',
                'route' => 'app_dashboard'
            ],
        ]
    ],
    [
        'title' => 'Campaigns',
        'roles' => [
            'ROLE_USER'
        ],
        'items' => [
            [
                'title' => 'All campaigns',
                'route' => 'campaigns_index'
            ],
            [
                'title' => 'Create new',
                'route' => 'campaigns_index'
            ],
            [
                'title' => 'Reports',
                'route' => 'campaigns_index'
            ],
        ]
    ]
];