<?php

require_once BASE_URL . "/src/service/auth/index.php";

class Logout extends Controller {
  public function index(){
    switch($_SERVER['REQUEST_METHOD']){
      case "GET":
        $this->view("home/index.php");
        break;
      case "POST":
        break;
    }
  }

  public function logout(){
    if(!(isset($_SESSION['username']) && isset($_SESSION['user_id']))){
      http_response_code(301);
      header("Location: " . BASE_URL . "/");
      return;
    }

    $auth_service = new AuthService();
    $user = $auth_service->logout();
  }
}

?>