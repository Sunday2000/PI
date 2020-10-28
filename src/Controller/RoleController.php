<?php 
namespace App\Controller;
use App\App;
use App\Model\User;
use App\Router;

abstract class RoleController{

    public static function clientRole(Router $router):User
    {
        $user = App::getAuth()->user();

        if (! App::getAuth()->requireRole('CLIENT', 'ADMIN') )
        {
            $forbid = $router->url('login-refused').'1';
            header("Location: $forbid");
            exit();
        }

        return $user;
    }

    public static function adminRole(Router $router):User
    {
        $user = App::getAuth()->user();

        if (! App::getAuth()->requireRole('ADMIN') )
        {
            $forbid = $router->url('login-refused').'1';
            header("Location: $forbid");
            exit();
        }

        return $user;
    }
}

?>