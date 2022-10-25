<?php
require_once __DIR__ . '/controller.php';
class Healthcheck extends Controller {
    public function index() {
        $data = [
            'status' => 'OK'
        ]; 
        
        // header('Content-type: application/json');
        $json = json_encode( $data );
        http_response_code(200);
        echo $json;
    }
}
?>