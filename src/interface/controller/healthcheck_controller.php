<?php
require_once BASE_URL . '/src/interface/controller/controller.php';
require_once BASE_URL . '/src/interface/controller/utils/index.php';
class Healthcheck extends Controller {
    public function index() {
        switch($_SERVER["REQUEST_METHOD"]){
            case "GET":
                $data = [
                    'status' => 'OK'
                ]; 

                response_json($data, 200);
            default:
                response_not_allowed_method();
                return;
        }
    }
}