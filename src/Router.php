<?php

    namespace App;

    use AltoRouter;
    use App\Controller\Controller;

    class Router
    {
        private $router;
        private $match;

        public function __construct()
        {
            $this->router = new AltoRouter();
        }

        public function getMatch():array
        {
            return $this->match;
        }

        public function setMatch(array $match): void
        {
            $this->match = $match;
        }

        public function get(string $url, $target, ?string $name = null):self
        {
            $this->router->map('GET', $url, $target, $name);
            return $this;
        }

        public function post(string $url, $target, ?string $name = null):self
        {
            $this->router->map('POST', $url, $target, $name);
            return $this;
        }

        public function update(string $url, $target, ?string $name = null):self
        {   
            $this->router->map('UPDATE', $url, $target, $name);
            return $this;
        }

        public function delete(string $url, $target, ?string $name = null):self
        {
            $this->router->map('DELETE', $url, $target, $name);
            return $this;
        }

        public function url(string $name, array $data = [])
        {
            return $this->router->generate($name, $data);
        }

        public function run()
        {
            $match = $this->router->match();
            if ( !$match )
            {
                $match = $this->router->match(null, "DELETE");
            }

            if ( !$match )
            {
                $match = $this->router->match(null, "UPDATE");
            }
           // dump($match); die();
            $this->setMatch($match ?: []);
            
            if ( !empty($match) )
            {
                if ( is_callable($match['target']))
                {
                    call_user_func_array($match['target'], $match['params']);
                }
            }else
            {
                Controller::notFound();
            }
        }
    }
?>