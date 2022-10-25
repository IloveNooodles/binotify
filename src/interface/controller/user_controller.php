<?php

class User extends Controller {
    public function list() {
        
    }

    public function logout(){
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          $this->get_logout();
          break;
        case "POST":
          $this->post_logout();
          break;
      }
    }

    private function get_logout() {
      $this->view("home/index");
    }

    private function post_logout() {
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