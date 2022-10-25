<?php
require_once BASE_URL . '/src/service/search/index.php';
require_once BASE_URL . '/src/interface/controller/utils/index.php';

class User extends Controller {
    public function list() {
      $search_service = new SearchService();

      if (isset($_GET['page']) and $_GET['page'] > 0) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }

      $data = $search_service->search_all_user($page);

      $this->view('user/list', $data);
    }

    public function logout(){
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          redirect_home();
          break;
        case "POST":
          $this->logout_user();
          break;
      }
    }

    private function logout_user() {
      if(!(isset($_SESSION['username']) && isset($_SESSION['user_id']))){
        redirect_home();
        return;
      }
  
      $auth_service = new AuthService();
      $user = $auth_service->logout();
    }
}