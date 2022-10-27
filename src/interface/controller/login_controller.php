<?php

require_once BASE_URL . '/src/service/auth/index.php';

class Login extends Controller {
    public function index(){
      switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            if(!isset($_SESSION['username'])){
              $this->view("login/index");
              return;
            }
            redirect_home();
            return;
        case "POST":
            if(!isset($_SESSION['username'])){
              $this->login();
              return;
            }
            redirect_home();
            return;
        default:
            response_not_allowed_method();
            return;
      }
    }

    private function login() {
      switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
          $username = $_POST['username'];
          $password = $_POST['password'];
      
          if(!(isset($username) && isset($password))){
            $this->view("login/index");
            return;
          } 
          $auth_service = new AuthService();
          $username = $_POST['username']; $password = $_POST['password'];
          $status = $auth_service->login($username, $password);
          if($status == "SUCCESS"){
            redirect_home();
          } else {
            $this->view("login/index", ["status_message" => $status]);
          }
          return;
        default:
          response_not_allowed_method();
          return;
    }
  }
}