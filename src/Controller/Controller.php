<?php 
namespace App\Controller;

use App\App;

class Controller
{
    const VIEW_PATH = ROOT.DIRECTORY_SEPARATOR."views";
    protected $auth_names = ["login",  "register"];
    protected $firstPretName = "firstPret";
    protected $router;
    protected $pdo;

    public function __construct()
    {
        $this->router = App::getRouter();
        $this->pdo = App::getPDO();
    }

    public function welcome()
    {
        $this->render('all/index');
    }

    public function render(string $view, array $datas = [])
    {

        extract($datas);

        $match = $this->router->getMatch();
        
        $router = $this->router;
        //$root = ROOT;
        $view = str_replace('.', '/', $view);
        
        $to_load = self::VIEW_PATH.DIRECTORY_SEPARATOR.$view.'.php';
        $files = explode('/', $view);
        $file = $files[count($files) - 1];

        ob_start();
            require $to_load;
        $content = ob_get_clean();
        
        if ($match["name"] === "logout")
        {
            require $view;
        }elseif ( in_array($match["name"], $this->auth_names) || in_array($file, $this->auth_names) || $match["name"] == $this->firstPretName )
        {
            require self::VIEW_PATH.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."layout_auth.php";
        }elseif($view == 'all/index'){
            require $to_load;
        }else
        {
            require self::VIEW_PATH.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."layout.php";
        }
        
    }

    public static function notFound()
    {
        $view = self::VIEW_PATH.DIRECTORY_SEPARATOR.'404.php';
        require $view;
    }
}

?>