<?php 
namespace App\Model;
use App\App;
use Exception;
use AyubIRZ\PerfectMoneyAPI\PerfectMoneyAPI;

class Perfect{
    const WALLET_USD = "U26350504";
    
    private $user_pm;

    public function __construct(string $user_pm_login, string $user_pm_pass)
    {
        $this->user_pm = new PerfectMoneyAPI($user_pm_login, $user_pm_pass);
    }

    public function getBalance(string $currency_id = null)
    {
        return $this->user_pm->getBalance($currency_id);

    }

    public function getAccountName(string $accountID)
    {
        try{
            $PMname = $this->user_pm->getAccountName($accountID); // The account name(if it's valid) will return. Otherwise you have an error.
        } catch (Exception $exception) {
        return $exception->getMessage();
        }
        
        return $PMname;
    }

    public function transferFund(string $fromAccount, string $toAccount, int $amount, int $payementID = null, string $memo = null)
    {
        return $this->user_pm->transferFund($fromAccount, $toAccount, $amount, $payementID, $memo);
    }

    public static function paiement(array $pm_datas, User $user, string $message, bool $invest = false):array
    {
        $pm = new Perfect($pm_datas['pm_login'], $pm_datas['pm_pass']);
        
        if ( $pm && !( empty($pm_datas['wallet_id'])  /*|| empty($set_perfect_id)*/))
        {
            $time = time();

            if ( !$invest && isset($pm_datas["pret_id"]))
            {
                Pret::setReceiver($pm_datas["pret_id"], $pm_datas["receiver"]);
            }

            $transfert_status = [];

            if ( key_exists("bp_payement", $pm_datas) )
            {
                $pm_transfert = $pm->transferFund(Perfect::WALLET_USD, $pm_datas['receiver'], $pm_datas['pm_amount'], $time, $message);
            }else{
                $pm_transfert = $pm->transferFund($pm_datas['wallet_id'], Perfect::WALLET_USD, $pm_datas['pm_amount'], $time, $message);
            }
            
            if ( isset($pm_transfert["ERROR"]) )
            {
                $transfert_status['ERROR'] = $pm_transfert["ERROR"];
            }else{
                $operation = key_exists("bp_payement", $pm_datas) ? App::SEND : App::RECEIVE;
                $service_id = $invest ? Operation::getServiceId(Invest::INVEST) : Operation::getServiceId(Pret::PRET);
                App::transaction($user->getId(), $operation, htmlentities($pm_datas['pm_amount']), $service_id);
                $transfert_status["SUCCESS"] = "Paiement Réussi";
            }
        }else{
            $transfert_status['ERROR'] = "Veuillez vérifier les données soumises";
        }

        return $transfert_status;
    }
}
?>