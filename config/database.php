<?php

return [
    // Default database connection name
    'default'     => 'default',

    // The default fetch mode
    'fetch'       => \PDO::FETCH_OBJ,

    // Database connections
    'connections' => [

        'default' => [
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'database'  => 'mellivora',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'engine'    => 'innodb',
            'timezone'  => '+8:00',
            'prefix'    => '',
        ],

    ],

    // Migration repository table
    'migrations'  => 'migrations',
];
