<?php 
require dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'vendor/autoload.php';
use App\App;

    $user = App::getAuth()->user();

?>
<?php if ( isset( $match['params']['login'] ) ): ?>

    <div class="alert alert-success">
        Vous êtes bien connecté 
    </div>

<?php endif ?>