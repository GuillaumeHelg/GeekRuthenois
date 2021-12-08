<?php

spl_autoload_extensions(".php");
spl_autoload_register();

use yasmf\DataSource;
use yasmf\Router;

$dataSource = new DataSource(
    $host = 'localhost',
    $port = '3306', // 3306 for default MySql Config
    $db = 'my_activities_CC2',
    $user = 'root',
    $pass = 'root',
    $charset = 'utf8mb4'
);

$router = new Router() ;
$router->route($dataSource);
