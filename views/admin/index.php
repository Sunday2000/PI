<?php 

require dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'vendor/autoload.php';
use App\App;

App::getAuth()->requireRole('ADMIN', $router);

?>
réservé a l'admin