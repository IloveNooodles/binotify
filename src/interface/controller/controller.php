<?php

define("VIEW_DIR", $_ENV['PWD'] . '/src/view/');

class Controller {
    public function view($view, $data = []) {
        require_once VIEW_DIR . $view . '.php';
    }
}