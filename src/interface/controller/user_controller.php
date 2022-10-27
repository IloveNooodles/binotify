<?php
require_once BASE_URL . '/src/service/search/index.php';
require_once BASE_URL . '/src/interface/controller/utils/index.php';
require_once BASE_URL . '/src/middleware/middleware.php';

class User extends Controller {
    public function index(){
      $middleware = new Middleware();
      $can_access_admin = $middleware->can_access_admin_page();
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          if($can_access_admin){
            $this->list();
            return;
          }
          redirect_home();
          break;
        case "POST":
          $this->logout_user();
          break;
        default:
          response_not_allowed_method();
          break;
      }
    }

    public function list() {
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          $search_service = new SearchService();
          $page = 1;

          if (isset($_GET['page']) and $_GET['page'] > 0) {
            $page = $_GET['page'];
          } 

          $data = $search_service->search_all_user($page);
          $this->view('user/index', $data);
          return;
        default:
          response_not_allowed_method();
          break;
      }
    }

    private function logout_user() {
      switch($_SERVER['REQUEST_METHOD']){
        case "POST":
          if(!(isset($_SESSION['username']) && isset($_SESSION['user_id']))){
            redirect_home();
            return;
          }
        
          $auth_service = new AuthService();
          $auth_service->logout();
          redirect_home();
          return;
        default:
          response_not_allowed_method();
          break;
      }
    }
}