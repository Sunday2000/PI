<?php
namespace App\Model;

use PDO;
use App\App;
use DateTime;
use DateInterval;

class Invest extends Operation{

    const NUMBER_DAY = 25;
    const CRYPTO = "Crypto";
    const INVEST = "INVESTISSEMENT";
    
    protected $hash_code;

    public function __construct()
    {
        $this->pdo = App::getPDO();
    }

    public function getHashCode(): ?string
    {
        return $this->hash_code;
    }

    public function remainDays()
    {
        $today = new DateTime("now");
        $diff = $this->getDate()->diff($today);
        //dump($diff); die();
        return $diff->days < 0 ? 0 : $diff->days ;
    }

    public function update(array $datas, PDO $pdo)
    {
        //dump($datas['date']);die();
        $today = new DateTime('now');
        //$duration = "P".$datas['date']."D";
        $query = $pdo->prepare("UPDATE operation SET amount=:amount, withdrawal_way=:withdrawal_way, hash_code=:hash_code, receiver=:receiver, updated_at=:updated_at WHERE id=:invest_id");
        return $query->execute([
            "invest_id" => $this->id,
            "amount" => htmlentities($datas["amount"]),
            "hash_code" => htmlentities($datas["hash_code"]),
            "withdrawal_way" => $datas["withdrawal_way"] ?? null,
            "receiver" => $datas["receiver"],
            "updated_at" =>$today->format("Y-m-d H:i:s")
        ]);
    }

    public function profit():int
    {
        $passed = self::NUMBER_DAY - $this->remainDays();
        $percent = (self::NUMBER_DAY + 100) / self::NUMBER_DAY;

        return $passed*$percent;
    }

    public static function invest(int $id, PDO $pdo): ?self
    {

        $query = $pdo->prepare("SELECT * FROM operation WHERE id = :id");
        $query->execute([
            "id"=>$id,
        ]);
        $pret = $query->fetchObject(self::class);
        
        if (!$pret)
        {
            return null;
        }

        return $pret;
    }

    public static function putAmount(PDO $pdo, array $datas)
    {
        $today = new DateTime('now');
        $today_string = $today->format("Y-m-d H:i:s"); 
        $duration = "P".Invest::NUMBER_DAY."D";
        $date = $today->add(new DateInterval($duration))->format("Y-m-d H:i:s");
        foreach( $datas as $key => $data)
        {
            $query = $pdo->prepare('UPDATE operation SET amount = :amount, created_at = :created_at, date = :date WHERE id = :id');
            $query->execute([
                "id" => $key,
                "amount" => htmlentities($data),
                "created_at" => $today_string,
                "date" => $date
            ]);
        }
    }

    public static function getCrypto(PDO $pdo)
    {
        $service_id = Operation::getServiceId(Invest::INVEST);
        $query = $pdo->prepare("SELECT * FROM operation WHERE amount = 0 AND service_id = :service_id AND hash_code IS NOT NULL");
        $query->execute([
            "service_id" => $service_id
        ]);
        $datas = $query->fetchAll(PDO::FETCH_CLASS, self::class);

        return $datas;
    }

    public static function readyToPay(PDO $pdo)
    {
        $datas = self::getAll($pdo);
        $today = new DateTime("now");
        
        foreach ($datas as $key => $data)
        {
            if ($today < $data->getDate())
            {
                unset($datas[$key]);
            }
        }

        return $datas;
    }

    public static function current(PDO $pdo)
    {
        $datas = self::getAll($pdo);
        $today = new DateTime("now");
        
        foreach ($datas as $key => $data)
        {
            if ($today > $data->getDate())
            {
                unset($datas[$key]);
            }
        }

        return $datas;
    }

    public static function getAll(PDO $pdo):array
    {
        $service_id = Operation::getServiceId(Invest::INVEST);
        $query = $pdo->prepare("SELECT * FROM operation WHERE service_id = :service_id");
        $query->execute([
            "service_id" => $service_id
        ]);

        return $query->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getInvest(int $id, PDO $pdo)
    {
        $invest = Operation::getOperation($id, $pdo)->fetchObject(self::class);
        
        if (!$invest)
        {
            return null;
        }

        return $invest;
    }

    /*public static function getPerfect(PDO $pdo)
    {
        $service_id = Operation::getServiceId(Invest::INVEST);
        $query = $pdo->prepare("SELECT * FROM operation WHERE service_id = :service_id AND withdrawal_way = 'Perfect Money'");
        $query->execute([
            "service_id" => $service_id
        ]);
        $datas = $query->fetchAll(PDO::FETCH_CLASS, self::class);

        return $datas;
    }*/

}

?>