<?php
namespace App\Controller;

use PDO;
use App\App;
use Exception;
use App\Router;
use App\Controller\Controller;

class LoginController extends Controller{


    public function index()
    {
        $error = false;
        $this->render("forms.login", compact("error"));
    }

    public function login()
    {
        $error = false;
        $router = App::getRouter();
        $auth = App::getAuth();
        $user = $auth->login($_POST['email'], $_POST['password']);
        
        if ( $user )
        {
            if ( !$user->isAdmin() )
            {
                header("Location: {$router->url('home')} ");
                exit();
            }else{
                header("Location: {$router->url('admin')} ");
                exit();
            }
            
        }
        $error = true;
        $this->render("forms.login", compact("error"));
    }

    public function logout()
    {
        $router = App::getRouter();
        session_start();
        session_destroy();
        $login = $router->url('login');
        header("Location: $login");
    }

}
?>