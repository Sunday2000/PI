<?php

use App\Router;

require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router(dirname(__DIR__)."/views");

// Accueil
$router
    ->get('/home','all/index','home')
    ->get('/','all/login','login')
    ->get('/register/[a:success]','all/login','register-success')
    ->get('/register','all/register','register')
    ->post('/register','all/register')
    ->run();

