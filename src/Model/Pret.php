<?php 

namespace App\Model;

use PDO;
use App\App;
use DateTime;
use DateInterval;
use App\Model\User;
use App\Model\Operation;

class Pret extends Operation{
    
    const RATE = 3/100;
    const PRET = "PRET";
    const FILE_PRET ="P/";
    const TEMP = "M";
    
    private $filepath;

    public function __construct()
    {
        $this->pdo = App::getPDO();
    }

    public function setFilePath(string $path)
    {
        $this->filepath = $path;
    }

    public function getFilePath():string
    {
        return $this->filepath;
    }

    public function getAmountRated(): string
    {
        return $this->amount." USD";
    }

    public function getAmount(): int
    {
        $amount = $this->amount/(1 + Pret::RATE);
        return $amount;
    }

    public function withdrawalWay()
    {
        if ( !empty($this->bank) )
        {
            return $this->bank."  ".$this->bank_number;
        }

        return $this->getWithdrawal_way();
    }

    public function setValidate($operation):bool
    {
        $validate = parent::setValidate(self::PRET);

        if ($validate)
        {
            User::getUser($this->user_id)->setBalance($this->getAmount());
        }

        return $validate;
    }

    public static function validation(array $pret_id)
    {
        $pdo = App::getPDO();
        $prets = self::getAll();
        foreach ($pret_id["validate"] as $id)
        {
            $query = $pdo->prepare("SELECT * FROM operation WHERE id = :id");
            $query->execute([
                "id" =>(int) $id
            ]);
            $pret = $query->fetchObject(self::class);
        
            if ( !$pret->getValidate() )
            {
                $pret->setValidate(null);
            }

            if (in_array($pret,$prets))
            {
                unset($prets[array_keys($prets, $pret)[0]]);
            }
        }

        array_map('self::unvalidate', $prets);
        
    }

    public static function unvalidate(self $pret)
    {
        $pdo = App::getPDO();
        $query = $pdo->prepare("UPDATE operation set validate = null WHERE id = :id");
        if ($query->execute(["id"=>$pret->id]) )
        {
            $query = $pdo->prepare("UPDATE user set balance = null WHERE id = :user_id");
            $query->execute(["user_id" => $pret->user_id]);
        }
    }

    public function timeRemain(): string
    {
        $today = new DateTime("now");
        $diff = $today->diff($this->getDate());
        $mounth = $diff->y*12 + $diff->m;
        $time = $diff->d == 0 ? $mounth." mois" : $mounth." mois ".$diff->d." jours";
        return $time;   
    }

    public function countMounth():int
    {
        $today = new DateTime("now");
        $diff = $today->diff($this->getDate());
        return $diff->y*12 + $diff->m;
    }

    public function files(string $path)
    {
        $root = $path.App::FILE_PATH.self::FILE_PRET.$this->id;
        if (is_dir($root))
        {
            return glob($root."/*.*");
        }
    }

    public function storeFile(array $file, string $path)
    {
        $root = $path.App::FILE_PATH.self::FILE_PRET.$this->id;
        
        $ext_autorized = ['jpg', 'jpeg', 'gif','png', 'pdf', 'doc', 'docx'];

        if (is_dir($root) && !$this->validate)
        {
            array_map('unlink', glob($root."/*.*"));
            //dump(glob($root."/*"));dump(glob($root."/*.*"));die();
            rmdir($root);
        }

        
        if ($file['size'] <= 5000000)
        {
            $infofile = pathinfo($file['name']);
            $ext_file = $infofile['extension'] ?? null;

            if ( in_array($ext_file, $ext_autorized) )
            {
                if (is_dir($root))
                {
                    move_uploaded_file($file['tmp_name'], $root."/".basename($file['name']));
                }else if ( mkdir($root, 0777) )
                {
                    move_uploaded_file($file['tmp_name'], $root."/".basename($file['name']));
                }else
                {
                    return "Creation impossible";
                }
            }else
            {
                return "Extension du fichier non supportées";
            }
        }else
        {
            return "Fichier volumineux";
        }
        

        return false;
    }

    public function processStart(string $path):bool
    {
        return is_dir($path.App::FILE_PATH.self::FILE_PRET.$this->id);
    }

    public function update(array $datas, PDO $pdo)
    {
        //dump($datas['date']);die();
        $today = new DateTime('now');
        $datas["amount"] += (double)$datas["amount"] * Pret::RATE;
        $duration = "P".$datas['date']."M";
        $query = $pdo->prepare("UPDATE operation SET amount=:amount, bank=:bank, bank_number=:bank_number, withdrawal_way=:withdrawal_way, updated_at=:updated_at, date=:date WHERE id=:pret_id");
        return $query->execute([
            "pret_id" => $this->id,
            "amount" => htmlentities($datas["amount"]),
            "bank" => htmlentities($datas["bank"]),
            "bank_number" => htmlentities($datas["bank_number"]),
            "withdrawal_way" => $datas["withdrawal_way"] ?? null,
            "updated_at" =>$today->format("Y-m-d H:i:s"),
            "date" => $today->add(new DateInterval($duration))->format("Y-m-d H:i:s")
        ]);
    }

    public static function pret(int $id, PDO $pdo): ?self
    {
        $query = $pdo->prepare("SELECT * FROM operation WHERE user_id = :id AND service_id =:service_pret_id");
        $query->execute([
            "id"=>$id,
            "service_pret_id"=>self::getServiceId(self::PRET)
        ]);
        $pret = $query->fetchObject(self::class);
        
        if (!$pret)
        {
            return null;
        }

        return $pret;
    }
    
    public static function getPret(int $id, PDO $pdo)
    {
        $pret = Operation::getOperation($id, $pdo)->fetchObject(self::class);
        
        if (!$pret)
        {
            return null;
        }

        return $pret;
    }

    public static function getAll(): array
    {
        $pdo = App::getPDO();
        $pret_id = Pret::getServiceId(self::PRET);
        $query = $pdo->prepare("SELECT * FROM operation WHERE service_id = :service_pret_id");
        $query->execute([
            "service_pret_id"=>$pret_id
        ]);

        $pret = $query->fetchAll(PDO::FETCH_CLASS, Pret::class);

        return $pret;
    }
    
    public static function create(array $datas,int $id, PDO $pdo): bool
    {   
        $pret = Pret::pret($id, $pdo);

        if ( $pret ){
            return false;
        }
        
        $service_id = Pret::getServiceId(self::PRET);
        return self::createOperation($datas, $id, $pdo, $service_id, PRET::TEMP, Pret::RATE);
    } 

}

?>