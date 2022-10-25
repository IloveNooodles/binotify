<?php

require_once BASE_URL . '/src/service/auth/index.php';

class Login extends Controller {
    public function index(){
      switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            $this->view("login/index");
            break;
        case "POST":
            $this->login();
            break;
      }
    }

    private function login() {
        if(!(isset($_POST['username']) && isset($_POST['password']))){
          $this->view("login/index");
          return;
        } 
        $auth_service = new AuthService();
        $username = $_POST['username']; $password = $_POST['password'];
        $status = $auth_service->login($username, $password);
        
        if($status == "SUCCESS"){
          redirect_home();
        } else {
          $this->view("login/index");
        }
        return;
    }
}