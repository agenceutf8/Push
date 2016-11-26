<?php

// Doctrine (db) add your own database logs

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'push',
    'user'     => 'root',
    'password' => '',

);