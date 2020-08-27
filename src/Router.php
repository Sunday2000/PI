<?php

namespace App;

use AltoRouter;

class Router
    {
        private $router;
        private $view_path;

        public function __construct(string $view)
        {
            $this->router = new AltoRouter();
            $this->view_path = $view;
        }

        public function get(string $url, string $view, ?string $name = null):self
        {
            $this->router->map('GET', $url, $view, $name);
            return $this;
        }

        public function post(string $url, string $view, ?string $name = null):self
        {
            $this->router->map('POST', $url, $view, $name);
            return $this;
        }

        public function url(string $name, array $data = [])
        {
            return $this->router->generate($name, $data);
        }

        public function run()
        {
            $match = $this->router->match();
            if ( !is_null($match) )
            {
                $view = $this->view_path.DIRECTORY_SEPARATOR.$match['target'].'.php';
                $router = $this;
                if ($match['name'] !== 'home')
                {
                    ob_start();
                        require $view;
                    $content = ob_get_clean();
                    require $this->view_path.DIRECTORY_SEPARATOR."all".DIRECTORY_SEPARATOR."layout.php";
                }else{
                    require $view;
                }
            }
        }
    }
?>