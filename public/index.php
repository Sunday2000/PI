<?php

use App\App;
use App\Controller\Controller;
use App\Controller\UserController;
use App\Controller\AdminController;
use App\Controller\LoginController;
use App\Controller\RegisterController;

define("ROOT", dirname(__DIR__));

require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = App::getRouter();

$router

    // Accueil
    ->get('/',function(){
        $welcome = new Controller();
        $welcome->welcome();
    },'welcome')

    //login
    ->get('/login', function(){
        $forms = new LoginController();
        $forms->index();
    },'login')

    ->post('/login', function(){
        $forms = new LoginController();
        $forms->login();
    })
    ->get('/register/[a:success]', function () {
        $forms = new LoginController();
        $forms->index();
    }, 'register-success')
    ->get('/login/[i:forbid]', function() {
        $forms = new LoginController();
        $forms->index();
    }, 'login-refused')

    //logout
    ->get('/logout', function(){
        $logout = new LoginController();
        $logout->logout();
    }, 'logout')

    //register
    ->get('/register', function(){
        $register = new RegisterController();
        $register->index();
    },'register')
    ->post('/register',function () {
        $register = new RegisterController();
        $register->register();
    })

    //client
    ->get('/home', function (){
        $pret = new UserController();
        $pret->index();
    }, 'home')
    //->post('/home', 'client/index')
    //->get('/home/[i:login]', 'client/index', 'login-success')

    //admin
    ->get('/bpadmin', function(){
        $prets = new AdminController();
        $prets->pretIndex();
    }, 'admin')// Gestion des prets effectués

    ->post('/bpadmin/validate', function (){
        $validate = new AdminController();
        $validate->pretValidate();
    }, 'bpadmin-validate')

    ->post('/bpadmin/paiement', function (){
        $validate = new AdminController();
        $validate->pretPerfect();
    }, 'bpadmin-paiement')

    ->post('/bpadmin/sendFile', function (){
        $validate = new AdminController();
        $validate->sendFile();
    }, 'bpadmin-sendFile')

    ->delete('/bpadmin/delete/[i:delete]', function(int $id){
        $delete = new AdminController();
        $delete->pretDelete($id);
    }, 'bpadmin-delete')

    ->update('/bpadmin/update/[i:update]', function(int $id){
        $prets = new AdminController();
        $prets->pretUpdate($id);
    }, 'admin-pupdate')

    //Admin Invest
    ->get('/bpadmin-i', function(){
        $invest = new AdminController();
        $invest->investIndex();
    },'admin-invest')

    ->post('/bpadmin-i/setprice', function (){
        $invest = new AdminController();
        $invest->investSetPrice();
    }, 'admin-setprice')

    ->post('/bpadmin-i/paiement', function (){
        $invest = new AdminController();
        $invest->investPerfect();
    }, 'bpadmin-ipaiement')

    ->update('/bpadmin-i/update/[i:update]', function(int $id){
        $invest = new AdminController();
        $invest->investUpdate($id);
    },'bpadmin-iupdate')

    ->delete('/bpadmin-i/delete/[i:delete]', function(int $id){
        $invest = new AdminController();
        $invest->investDelete($id);
    },'bpadmin-idelete')

    //Administration
    ->get('/bpadmin-admin', function(){
        $admin = new AdminController();
        $admin->index();
    },'admin-admin')

    ->post('/bpadmin-create', function(){
        $admin = new AdminController();
        $admin->adminCreate();
    },'bpadmin-acreate')
    
    ->update('/bpadmin-update/[i:update]', function(int $id){
        $admin = new AdminController();
        $admin->adminUpdate($id);
    },'bpadmin-aupdate')

    ->delete('/bpadmin-delete/[i:delete]', function(int $id){
        $admin = new AdminController();
        $admin->adminDelete($id);
    },'bpadmin-adelete')

    //Pret
    ->get('/pret/first', function(){
        $pret = new UserController();
        $pret->firstPret();
    }, 'firstPret')

    ->post('/pret/updateUser', function(){
        $pret = new UserController();
        $pret->pretUpdateUser();
    }, 'updateUser')

    ->get('/pret', function(){
        $pret = new UserController();
        $pret->pretIndex();
    }, 'pret')

    ->post('/pret', function(){
        $create = new UserController();
        $create->pretCreate();
    },'pret-create')

    ->post('/pret/paiement', function(){
        $create = new UserController();
        $create->pretPerfect();
    },'pret-perfect')

    ->post('/pret/file', function(){
        $create = new UserController();
        $create->file();
    },'pret-file')

    ->update('/pret/update', function(){
        $update = new UserController();
        $update->pretUpdate();
    },'pret-update')

    ->delete('/pret/delete', function(){
        $delete = new UserController();
        $delete->pretDelete();
    }, 'pret-delete')

    //Investissement
    ->get('/invest', function(){
        $invest = new UserController();
        $invest->investIndex();
    }, 'invest')

    ->get('/invest/[i:days]', function(){
        $invest = new UserController();
        $invest->investIndex();
    }, 'invest-days')

    ->get('/invest/[i:success]', function(){
        $invest = new UserController();
        $invest->investIndex();
    }, 'invest-success')

    ->post('/invest/crypto', function(){
        $invest = new UserController();
        $invest->investCrypto();
    }, 'invest-crypto')

    ->post('/invest/paiement', function(){
        $invest = new UserController();
        $invest->investPerfect();
    }, 'invest-perfect')

    ->post('/invest/hash', function(){
        $invest = new UserController();
        $invest->investHash();
    }, 'invest-hash')
    
    //liste des services dans le login
    ->get('/data', function(){
        $datas = App::getQuery("SELECT user.email as email FROM user");
        require dirname(__DIR__).DIRECTORY_SEPARATOR.'bdd.php';
    })
    ->run();
    