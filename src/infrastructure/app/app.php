<?php

class App {
    protected $controller = 'login';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        if (isset($url[0]) and file_exists('application/interface/controller/' . $url[0] . '_controller.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        else if ($url == NULL && isset($_SESSION['role'])) {
            $this->controller = $_SESSION['role'];
        }
        else if (!file_exists('application/interface/controller/' . $url[0] . '_controller.php') && isset($_SESSION['role'])) {
            header('Location: ' . BASE_URL . '/');
        }

        require_once 'application/interface/controller/' . $this->controller . '_controller.php';
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
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
?> 