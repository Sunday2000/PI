<?php
namespace App\Controller;

use App\App;
use App\Auth;
use Exception;
use App\Model\Pret;
use App\Model\User;
use App\Model\Invest;
use App\Model\Perfect;
use App\Model\Operation;
use App\Controller\Controller;
use App\Controller\RoleController;

class UserController extends Controller{

    const INVEST_MESS = "Service Investissement bpal";
    const PRET_MESS = "Service Pret bpal";

    public function __construct()
    {
        $this->router = App::getRouter();
        RoleController::clientRole($this->router);
        $this->pdo = App::getPDO();
    }

    public function index()
    {
        
        if ( session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }

        $user = null;

        try
        {
            $user = RoleController::clientRole($this->router);
        }catch( Exception $e)
        {
            header("Location: {$this->router->url('login')}");
            exit();
        }

        $this->render('client/index', compact("user"));
    }
    
    public function investIndex()
    {   
        $this->render('services/invest', $this->investDefaultVariables());
    }

    public function investDefaultVariables()
    {
        $auth = App::getAuth();
        $user = RoleController::clientRole($this->router);
        $perfect = Operation::PERFECT;
        $invest_days = Invest::NUMBER_DAY;
        $crypto = Invest::CRYPTO;
        $invests = $user->getInvest();
        $pm_transfert_error = null;
        $pm_transfert = null;

        return compact('user', 'invests', 'pm_transfert_error', 'pm_transfert', 'invest_days', 'perfect', 'crypto');
    }

    public function investCrypto()
    {
        
        if ( !empty($_POST["makeRequest"]) )
        {
            $invest = Invest::invest((int)$_POST["makeRequest"], $this->pdo);

            if (is_object($invest) )
            {
                if ( $invest->remainDays() == 0)
                {
                    $invest->setValidate(Invest::INVEST);
                    //$redirect = $router->url('invest').'/Error';
                    header("Location: {$this->router->url('invest-success')}1");
                }else{
                    header("Location: {$this->router->url('invest-days')}0");   
                }
            }else{
                header("Location: {$this->router->url('invest-success')}0");
            }
        }

        $this->render('services/invest', $this->investDefaultVariables());
    }

    public function investPerfect()
    {
        extract($this->investDefaultVariables());
    
        $service_id = Invest::getServiceId(Invest::INVEST);

        if ( !( empty($_POST['pm_login']) || empty($_POST['pm_pass']) ) )
        {
            $status = Perfect::paiement($_POST, $user, self::INVEST_MESS, true);

            if ( isset($status["ERROR"]) )
            {
                $pm_transfert_error = $status["ERROR"];
            }

            if (isset($status["SUCCESS"]) )
            {
                $pm_transfert = $status["SUCCESS"];
            
                Invest::createOperation($_POST, $user->getId(), $this->pdo, $service_id, "D");
            }

        }

        $this->render('services/invest', compact('user', 'invests', 'pm_transfert_error', 'pm_transfert'));
    }

    public function investHash()
    {
        if ( !(empty($_POST["hash_code"]) && empty($_POST["receiver"])) )
        {
            $user = RoleController::clientRole($this->router);
            $service_id = Invest::getServiceId(Invest::INVEST);
            
            Invest::createOperation($_POST, $user->getId(), $this->pdo, $service_id, "D");
            header("Location: {$this->router->url('invest')}");
        }
    }

    public function pretDefaultVariables()
    {
        $auth = App::getAuth();
        $pret_op = null;
        $file_error = null;
        $pret = Pret::pret(Auth::connected($this->router), $this->pdo);
        $user = RoleController::clientRole($this->router);
        $userFiles = $user->files(ROOT);
        
        return compact("pret", "user", "file_error", "pret_op", "auth", "userFiles");
    }
    
    public function pretIndex()
    {
        $user = RoleController::clientRole($this->router);

        //si l'un des champs profession, salary, city, country est vide
        if ( empty($user->getProfession() ) )
        {
            header("Location: {$this->router->url('firstPret')}");
            exit();
        }
        
        $this->render('services/pret', $this->pretDefaultVariables());
    }

    public function pretPerfect()
    {
        extract($this->pretDefaultVariables());

        $pm_transfert = null;
        $pm_transfert_error = null;

        if ( !( empty($_POST['pm_login']) || empty($_POST['pm_pass']) ) )
        {
            $_POST["pret_id"] = $pret->getId();
            $status = Perfect::paiement($_POST, $user, self::PRET_MESS);

            if ( isset($status["ERROR"]) )
            {
                $pm_transfert_error = $status["ERROR"];
            }
            if (isset($status["SUCCESS"]) )
            {
                $pm_transfert = $status["SUCCESS"];
            }   
        }elseif( !(empty($_POST['receiver']) || empty($_POST['pret_id'])) ){
            Pret::setReceiver($_POST["pret_id"], $_POST["receiver"]);
        }else{
            $pm_transfert_error = "Veuillez remplir tous les champs";
        }

        $this->render('services/pret', compact("pret", "userFiles","user", "file_error", "pret_op", "pm_transfert_error",  "pm_transfert"));
    }

    public function pretUpdateUser()
    {
        $user = RoleController::clientRole($this->router);
        if ( !(empty($_POST['profession']) || empty($_POST['city']) || empty($_POST['country']) || 
        empty($_POST['salary'])) )
        {
            if ( $user->update($_POST, $this->pdo) )
            {
                header("Location: {$this->router->url('pret')}");
                exit();
            }else{
                $error="Verifiez les informations soumises";
                $this->render('forms/completePretDatas', compact('error'));
                exit();
            }
        }
        
    }

    public function firstPret()
    {
        $this->render('forms/completePretDatas');
    }

    public function file(bool $isAdmin = false)
    {
        extract($this->pretDefaultVariables());
        
        if ( isset($_FILES['file']) && $_FILES['file']['error'] == 0 )
        {
            if ( !empty($pret))
            {
                $file_error = $pret->storeFile($_FILES['file'], ROOT);
            }
            
        }elseif ( isset($_FILES['file']) && $_FILES['file']['error'] == 1)
        {
            $file_error = "Le fichier n'est pas en regle";
        }
        
        if ( $isAdmin )
        {
            return $file_error;
        }
        
        $this->render('services/pret', compact("pret", "user", "file_error", "pret_op", "auth"));
    }

    public function pretCreate()
    {
    
        extract($this->pretDefaultVariables());
        
        $pret_error = $this->pretCheckDatas($pret);
        
        if ( is_null($pret_error) && is_null($pret))
        {
            $create = Pret::create($_POST, Auth::connected($this->router), $this->pdo);
            if ( $create )
            {
                header("Location: {$this->router->url('pret')}");
                exit(); 
            }else{
                $pret_error = "Echec de creation";
            }
        }

        $this->render('services/pret', compact("pret", "user", "file_error", "pret_op", "pret_error"));
    }

    public function pretUpdate()
    {
        extract($this->pretDefaultVariables());
        $pret_error = $this->pretCheckDatas($pret);
        
        if ( is_null($pret_error) )
        {
            $update = $pret->update($_POST, $this->pdo);

            if ( $update )
            {
                header("Location: {$this->router->url('pret')}");
                exit(); 
            }else{
                $pret_error = "Echec de modification";
            }

        }

        $this->render('services/pret', compact("pret", "userFiles", "user", "file_error", "pret_op", "pret_error"));
    }

    public function pretCheckDatas($pret)
    {
        $pret_error = null;

        // if( !is_object($pret) )
        // {
        //     return "Impossible de modifier";
        // }

        if( empty($_POST['date']) || empty($_POST['amount']))
        {
            $pret_error = "Veuillez remplir tous les champs";
        }elseif ( !(empty($_POST['bank']) XOR empty($_POST['withdrawal_way'])) )
        {
            $pret_error = "Un seule mode de payement est acceptée";
        }elseif( !(empty($_POST['bank'])) && empty($_POST['bank_number'])) {
            $pret_error = "Veuillez remplir le numero de compte";
        }elseif( $pret && ($pret->processStart(ROOT) || $pret->getValidate()) )
        {
            $pret_error = "Impossible de modifier, Pret en cours d'analyse";
        }

        return $pret_error;
    }

    public function deletePretFile(string $path)
    {
        if ( is_dir($path) )
        {
           $contains = glob($path.'/*');

           foreach( $contains as $contain )
           {
                if ( is_file($contain) )
                {
                    unlink($contain);
                }

                if( is_dir($contain) )
                {
                    $this->deletePretFile($contain);
                }
           }

           rmdir($path);
        }
    }

    public function pretDelete(){

        extract($this->pretDefaultVariables(),EXTR_SKIP);
        
        if ( is_object($pret) )
        {
            $root = ROOT.App::FILE_PATH.Pret::FILE_PRET.$pret->getId();
            $this->deletePretFile($root);

            if ( $pret->delete() )
            {
                header("Location: {$this->router->url("pret")}");
                exit();
            }
        }
        
        $pret_op = false;
        $this->render('services/pret', compact("pret", "userFiles", "user", "file_error", "pret_op"));
    }
}

?>