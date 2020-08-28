<?php

use App\Router;

require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router(dirname(__DIR__)."/views");


$router

    // Accueil
    ->get('/welcome','all/index','welcome')

    //login
    ->get('/','all/login','login')
    ->post('/','all/login')
    ->get('/register/[a:success]','all/login', 'register-success')
    ->get('/login/[i:forbid]', 'all/login', 'login-refused')

    //logout
    ->get('/logout', 'all/logout')
    
    //register
    ->get('/register','all/register','register')
    ->post('/register','all/register')

    //client
    ->get('/home', 'client/index', 'home')
    ->get('/home/[i:login]', 'client/index', 'login-success')
    ->run();

