<?php
require_once BASE_URL . '/src/service/search/index.php';
require_once BASE_URL . '/src/utils/http_response.php';

class User extends Controller {
    public function list() {
      $search_service = new SearchService();
      $data = $search_service->user($_GET['page']);

      // $this->view('user/list', $data);
      response_json($data, 200);
    }

    public function logout(){
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          $this->redirect_home();
          break;
        case "POST":
          $this->logout_user();
          break;
      }
    }

    private function redirect_home() {
      header("Location: /");
    }

    private function logout_user() {
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