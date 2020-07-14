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
                'url' => 'app_dashboard'
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
                'url' => 'campaigns_index'
            ],
            [
                'title' => 'Create new',
                'url' => 'campaigns_index'
            ],
            [
                'title' => 'Reports',
                'url' => 'campaigns_index'
            ],
        ]
    ]
];