<?php 

namespace App\Controller;

use App\App;
use Exception;
use App\Model\Pret;
use App\Model\User;
use App\Model\Invest;
use App\Model\Perfect;
use App\Model\Operation;
use App\Controller\Controller;
use App\Controller\RoleController;

class AdminController extends Controller{

    const INVEST_MESS = "Service Investissement bpal";
    const PRET_MESS = "Service Pret bpal";

    public function __construct()
    {
        $this->router = App::getRouter();
        RoleController::adminRole($this->router);
        $this->pdo = App::getPDO();
    }

    public function index()
    {
        $user = $this->isAdmin();
        $admins = User::getAdmins($user);

        $this->render('admin/admin', compact('admins','user'));
    }

    public function adminCreateUpdate(int $update = null)
    {
        $user = RoleController::adminRole($this->router);
        $admins = User::getAdmins($user);
        $error = null;
        $pass_error = null;
        
        if (! (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['tel']) || 
        empty($_POST['email']) || empty($_POST['password']) || empty($_POST['sex']) ))
        {
            $insert = App::getAuth();
            $pass_error = ($_POST['password'] === $_POST['re_pass']) ? false : true;

            if ( !$pass_error)
            {
                $success = null;
                try
                {
                    $adminNameId = (int) User::getAdminNameId()['id'];
                    if ( is_null($update) )
                    {
                        $success = $insert->register($_POST, $adminNameId);
                    }else{
                        $user = User::getUser($update);
                        $success = $user->adminUpdate($_POST,$this->pdo);
                    }
                    
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
                    $admin_path = $this->router->url('admin-admin');
                    header("Location: $admin_path ");
                }
                
            }else{
                $pass_error = "Mot de passes non identique";
            }

        }else{
            $error = "Veuillez renseigner tous les champs";
        }

        $this->render('admin/admin', compact('admins','user', 'error', 'pass_error'));
    }

    public function adminCreate()
    {
        $this->adminCreateUpdate();
    }

    public function adminUpdate(int $id)
    {
        $this->adminCreateUpdate($id);
    }

    public function adminDelete(int $id)
    {
        $delete_error = null;
        $to_delete = User::getUser($id);
        if ( !$to_delete->delete($this->pdo) )
            $delete_error = "Suppression non éffectuée";

        $user = $this->isAdmin();
        $admins = User::getAdmins($user);

        $this->render('admin/admin', compact('admins','user', 'delete_error'));
    }

    private function investDefaultVariables()
    {
        $user = null;
        $type = Operation::PERFECT;
        $crypt_invests = Invest::getCrypto($this->pdo);
        $to_pays = Invest::readyToPay($this->pdo);
        $current_invests = Invest::current($this->pdo);
        $all = $current_invests;
        
        foreach ($to_pays as $to_pay)
        {
            $all[] = $to_pay;
        }

        return compact( 'user', 'crypt_invests', 'to_pays', 'type', 'current_invests', 'all');
    }
    
    public function investIndex()
    {
        $user = $this->isAdmin();
        extract($this->investDefaultVariables(), EXTR_SKIP);
        //dump($all); die();
        $this->render('admin/invest', compact( 'user', 'crypt_invests', 'to_pays', 'type', 'current_invests', 'all'));
    }

    public function investSetPrice()
    {
        $user = $this->isAdmin();
        extract($this->investDefaultVariables(), EXTR_SKIP);


        if ( !empty($_POST["price"]) )
        {
            Invest::putAmount($this->pdo, $_POST["price"]);
            header("Location: {$this->router->url("admin-invest")}");
        }
        $this->render('admin/invest', compact('user', 'crypt_invests', 'to_pays', 'type', 'current_invests', 'all'));
    }

    public function investPerfect()
    {
        $user = $this->isAdmin();
        extract($this->investDefaultVariables(), EXTR_SKIP);

        if ( !( empty($_POST['pm_login']) || empty($_POST['pm_pass']) ) )
        {
            $_POST["bp_payement"] = true;
            
            $status = Perfect::paiement($_POST, $user, self::INVEST_MESS, true);

            if ( isset($status["ERROR"]) )
            {
                $pm_transfert_error = $status["ERROR"];
            }
            if (isset($status["SUCCESS"]) )
            {
                $pm_transfert = $status["SUCCESS"];
            }
        }   

        $this->render('admin/invest', compact('user', 'crypt_invests', 'to_pays', 'type', 'current_invests', 'all'));
    }

    public function investDelete(int $id){

        $user = $this->isAdmin();
        extract($this->investDefaultVariables(), EXTR_SKIP);

        $invest = Invest::getInvest($id, $this->pdo);
        
        if ( $invest->delete() )
        {
            header("Location: {$this->router->url("admin-invest")}");
            exit();
        }
        
        $invest_op = false;
        $this->render('admin/invest', compact( 'user', 'invest_op', 'crypt_invests', 'to_pays', 'type', 'current_invests', 'all'));
    }

    public function investUpdate(int $id)
    {
        $user = $this->isAdmin();

        $invest = Invest::getInvest($id, $this->pdo);

        $update_error = $this->InvestCheckDatas($invest);
        
        if ( is_null($update_error) )
        {
            $update = $invest->update($_POST, $this->pdo);

            if ( $update )
            {
                header("Location: {$this->router->url('admin-invest')}");
                exit(); 
            }else{
                $update_error = "Echec de modification";
            }
        }

       extract($this->investDefaultVariables(), EXTR_SKIP);
    
        $this->render('admin/invest', compact( 'user', 'update_error', 'crypt_invests', 'to_pays', 'type', 'current_invests', 'all'));
    }

    public function InvestCheckDatas($invest): ?string
    {
        $invest_error = null;

        if( !is_object($invest) )
        {
            return "Impossible de faire une modification";
        }

        if( empty($_POST['amount']) || empty($_POST['withdrawal_way']) || empty($_POST['hash_code']))
        {
            $invest_error = "Veuillez vérifier les informations";
        }

        return $invest_error;
    }

    public function isAdmin()
    {
        try
        {
            $user = RoleController::adminRole($this->router);
            
        }catch( Exception $e)
        {
            header("Location: {$this->router->url('login')}");
            exit();
        }

        return $user;
    }

    public function pretDefaultVariables()
    {
        $user = null;
        $prets = null;
        $file_error = null;
        $pm_transfert_error = null;
        $pm_transfert = null;

        return compact("user", "prets", "file_error", "pm_transfert_error", "pm_transfert");
    }

    public function pretIndex()
    {
        $user = $this->isAdmin();
        extract($this->pretDefaultVariables(), EXTR_SKIP);
        $prets = Pret::getAll();
        $this->render('admin/index' ,compact("user", "prets", "file_error", "pm_transfert_error", "pm_transfert"));
    }

    public function pretCheckDatas($pret)
    {
        $pret_error = null;

        if( !is_object($pret) )
        {
            return "Impossible de modifier";
        }

        if( empty($_POST['date']) || empty($_POST['amount']))
        {
            $pret_error = "Veuillez vérifier les informations";
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

    public function pretUpdate(int $id)
    {
        $user = $this->isAdmin();
        $pret = Pret::getPret($id, $this->pdo);

        $pret_error = $this->pretCheckDatas($pret);
        
        if ( is_null($pret_error) )
        {
            $update = $pret->update($_POST, $this->pdo);

            if ( $update )
            {
                header("Location: {$this->router->url('admin')}");
                exit(); 
            }else{
                $pret_error = "Echec de modification";
            }
        }

        extract($this->pretDefaultVariables(), EXTR_SKIP);
        $prets = Pret::getAll();
        $this->render('admin/index' ,compact("user", "pret_error", "prets", "file_error", "pm_transfert_error", "pm_transfert"));
    }

    public function pretValidate()
    {
        $user = $this->isAdmin();
        extract($this->pretDefaultVariables(), EXTR_SKIP);
        $prets = Pret::getAll();

        if ( !empty($_POST["validate"]) )
        {
            Pret::validation($_POST);
        }else{
            
            foreach($prets as $pret)
            {
                Pret::unvalidate($pret);
            }
        }

        header("Location: {$this->router->url('admin')}");
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

    public function pretDelete(int $id){

        $user = $this->isAdmin();
        extract($this->pretDefaultVariables(), EXTR_SKIP);
        $prets = Pret::getAll();

        $pret = Pret::getPret($id, $this->pdo);
        
        if ( is_object($pret) )
        {
            $root = ROOT.App::FILE_PATH.Pret::FILE_PRET.$pret->getId();
            $this->deletePretFile($root);
            if ( $pret->delete() )
            {
                header("Location: {$this->router->url("admin")}");
                exit();
            }
        }
        
        $pret_op = false;
        $this->render('admin/index' ,compact("user", "prets", "pret_op", "file_error", "pm_transfert_error", "pm_transfert"));
    }

    public function sendFile()
    {
        $user = $this->isAdmin();
        extract($this->pretDefaultVariables(), EXTR_SKIP);
        $prets = Pret::getAll();
        
        if ( !empty($_FILES) && isset($_POST["pret_id"]) )
        {
            $_FILES["pret_id"] = $_POST["pret_id"];
            //dump($_FILES);die();
            $file_error = $this->file(true);
        }

        $this->render('admin/index', compact("user", "prets", "file_error", "pm_transfert_error", "pm_transfert"));
    }

    public function pretPerfect()
    {
        $user = $this->isAdmin();
        extract($this->pretDefaultVariables(), EXTR_SKIP);
        $prets = Pret::getAll();

        if ( !( empty($_POST['pm_login']) || empty($_POST['pm_pass']) ) )
        {
            $_POST["bp_payement"] = true;
            
            $status = Perfect::paiement($_POST, $user, self::PRET_MESS);

            if ( isset($status["ERROR"]) )
            {
                $pm_transfert_error = $status["ERROR"];
            }
            if (isset($status["SUCCESS"]) )
            {
                $pm_transfert = $status["SUCCESS"];
            }
        }

        $this->render('admin/index', compact("user", "prets", "file_error", "pm_transfert_error", "pm_transfert"));
    }

    public function file(bool $isAdmin = false)
    {
        extract($this->pretDefaultVariables());
        
        if ( isset($_FILES['file']) && $_FILES['file']['error'] == 0 )
        {
            if ( empty($pret))
            {
                $file_error = User::storeFile($_FILES['file'], ROOT, $_FILES["pret_id"]);
            }
            
        }else if ( isset($_FILES['file']) && $_FILES['file']['error'] == 1)
        {
            $file_error = "Le fichier n'est pas en regle";
        }
        
        if ( $isAdmin )
        {
            return $file_error;
        }
        
        $this->render('services/pret', compact("pret", "user", "file_error", "pret_op", "auth"));
    }
}

?>