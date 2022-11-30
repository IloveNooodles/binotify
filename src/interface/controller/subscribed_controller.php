<?php
require_once BASE_URL . '/src/middleware/middleware.php';

class Subscribed extends Controller {
    public function index() {
        $middleware = new Middleware();
        $is_logged_in = $middleware->is_logged_in();
        if (!$is_logged_in) {
            redirect_home();
            return;
        }
        $this->view("subscribed/index");
        return;
    }
}