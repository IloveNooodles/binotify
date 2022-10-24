<?php

define("BASE_DIR", $_ENV['PWD'] . '/src/interface/controller/');

class App {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();
        if (isset($url[0]) and file_exists(BASE_DIR . $url[0] . '_controller.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once BASE_DIR . $this->controller . '_controller.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        /* route /a/b/c will return array consist of [a, b, c] */  
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            if(count($url) > 1){
              array_shift($url);
            }

            return $url;
        }
    }
}
?> 