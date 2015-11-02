<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'  => 'Sqlite',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => __DIR__ .'/../phlame.db',
        'charset'  => 'utf8',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../controllers/',
        'modelsDir'      => __DIR__ . '/../models/',
        'migrationsDir'  => __DIR__ . '/../migrations/',
        'viewsDir'       => __DIR__ . '/../views/',
        'baseUri'        => '/phlame/'
    )
));
