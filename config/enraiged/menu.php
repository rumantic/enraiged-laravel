<?php

return [

    [
        'icon' => 'pi pi-home',
        'route' => '/',
        'secure' => [
            'method' => 'isGuest',
        ],
    ],

    'Dashboard' => [
        'icon' => 'pi pi-home',
        'route' => '/dashboard',
        'secure' => [
            'method' => 'isAuth',
        ],
    ],

    'Realty' => [
        'icon' => 'pi pi-building',
        'route' => '/realty',
        'secure' => [
            'method' => 'roleIs',
            'role' => 'Administrator',
        ],
    ],

    'Manage Users' => [
        'icon' => 'pi pi-users',
        'route' => '/users',
        'secure' => [
            'method' => 'roleIs',
            'role' => 'Administrator',
        ],
    ],

];
