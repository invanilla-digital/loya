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
    ],
    [
        'title' => 'Users',
        'roles' => [
            'ROLE_USER_ADMIN'
        ],
        'items' => [
            [
                'title' => 'All users',
                'route' => 'users_index'
            ],
            [
                'title' => 'Create new user',
                'route' => 'users_create'
            ],
        ]
    ]
];