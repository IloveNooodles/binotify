<?php
require_once BASE_URL . '/src/interface/controller/controller.php';
require_once BASE_URL . '/src/interface/controller/utils/index.php';
class Healthcheck extends Controller {
    public function index() {
        $data = [
            'status' => 'OK'
        ]; 

        response_json($data, 200);
    }
}