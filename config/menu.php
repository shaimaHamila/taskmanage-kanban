<?php

return [
    'common' => [
        [
            'title' => 'Tasks management',
            'route' => 'tasks',
            'roles' => ['admin', 'employee'],
            'icon' => 'fa-tasks',
        ],
    ],

    'admin' => [
        [
            'title' => 'Users management',
            'route' => 'users',
            'roles' => ['admin'],
            'icon' => 'fa-users',
        ],
    ],

    'employee' => [
        // Add employee-specific routes here if any
    ],
];
