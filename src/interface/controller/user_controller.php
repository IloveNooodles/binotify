<?php
require_once BASE_URL . '/src/service/search/index.php';
require_once BASE_URL . '/src/interface/controller/utils/index.php';

class User extends Controller {
    public function index(){
      $role = $_SESSION['role'];
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          if(isset($role) && $role === 'admin'){
            $this->view("")
          }
          redirect_home();
          break;
        case "POST":
          $this->logout_user();
          break;
      }
    }

    public function list() {
      $search_service = new SearchService();
      $page = $_GET['page'];

      if (isset($page) and $page > 0) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }

      $data = $search_service->search_all_user($page);

      $this->view('user/list', $data);
    }

    private function logout_user() {
      $username = $_SESSION['username'];
      $user_id = $_SESSION['user_id'];

      if(!(isset($username) && isset($user_id))){
        redirect_home();
        return;
      }
    
      $auth_service = new AuthService();
      $auth_service->logout();
      redirect_home();
    }
}