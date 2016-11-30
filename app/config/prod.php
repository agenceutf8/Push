<?php

// Doctrine (db) add your own database logs
/*

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'db658517421.db.1and1.com',
    'port'     => '3306',
    'dbname'   => 'db658517421',
    'user'     => 'dbo658517421',
    'password' => 'Iesa2016',
);

*/

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'push',
    'user'     => 'root',
    'password' => 'root',
);