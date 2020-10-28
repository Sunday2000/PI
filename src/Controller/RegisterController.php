<?php 
namespace App\Controller;

use PDO;
use App\App;
use Exception;


class RegisterController extends Controller
{
    public function index()
    {
        $this->render("forms.register", $this->defaultVariables());
    }

    public function register()
    {
        extract($this->defaultVariables());
        
        if (! (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['tel']) || 
        empty($_POST['email']) || empty($_POST['password']) || empty($_POST['terms'])
        /*|| empty($_POST['profession']) || empty($_POST['city']) || empty($_POST['country']) || 
        empty($_POST['salary'])*/ || empty($_POST['sex']) ))
        {
            $insert = App::getAuth();

            $pass_error = ($_POST['password'] === $_POST['re_pass']) ? false : true;

            if ( ! $pass_error)
            {
                try
                {
                    $success = $insert->register($_POST);
                }catch(Exception $e)
                {
                    if ( str_contains($e->getMessage(), $_POST['email']) )
                    {
                        $error = "L'email existe déja";
                    }else{
                        $error = $e->getMessage();
                    }
                    
                }
                
                if ( $success )
                {
                    $login_path = $this->router->url('register-success').'success';
                    header("Location: $login_path ");
                }
                
            }

        }

        $this->render("forms.register", compact("error", "success", "pass_error", "services"));
    }

    public function getServices()
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT id, name FROM service");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function defaultVariables()
    {
        $pass_error = null;
        $error = null;
        $success = null;
        $services = $this->getServices();

        return compact("pass_error", "error", "success", "services");
    }

}
?>