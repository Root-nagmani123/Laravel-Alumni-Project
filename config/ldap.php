<?php

return [

    'default' => env('LDAP_CONNECTION', 'default'),

    'connections' => [

        'default' => [
            'hosts' => explode(' ', env('LDAP_HOSTS', '103.225.204.25')),
            'username' => env('LDAP_USERNAME', 'adtest@lbsnaa.gov.in'),
            'password' => env('LDAP_PASSWORD', 'india@@#$^'),
            'port' => env('LDAP_PORT', 389),
            'base_dn' => env('LDAP_BASE_DN', 'DC=lbsnaa,DC=gov,DC=in'),
            'timeout' => env('LDAP_TIMEOUT', 10),
            'use_ssl' => env('LDAP_SSL', false),
            'use_tls' => env('LDAP_TLS', false),
        ],

    ],

    'logging' => [
        'enabled' => env('LDAP_LOGGING', true),
        'channel' => env('LOG_CHANNEL', 'stack'),
        'level' => env('LOG_LEVEL', 'info'),
    ],

    'cache' => [
        'enabled' => env('LDAP_CACHE', false),
        'driver' => env('CACHE_DRIVER', 'file'),
    ],

];