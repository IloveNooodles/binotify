<?php
require_once BASE_URL . '/src/interface/model/user.php';
require_once BASE_URL . '/src/infrastructure/password/password.php';

class Register extends Controller {
    public function index(){
      switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
          $this->view("register/index");
          break;
        case "POST":
          $this->register();
          break;
        default:
          response_not_allowed_method();
          return;
          break;
      }
    }

    public function validate(){
      switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
          $email_regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
          $username_validate = 'true';
          $email_validate = 'true';
          $password_validate = 'true';
          $confirm_password_validate = 'true';

          $user_model = new UserModel();
          if (!empty($_POST['username']) && !empty($user_model->find_user_by_username($_POST['username']))) {
            $username_validate = 'Username already exists';
          }
          if (!empty($_POST['username']) && preg_match('/\s/', $_POST['username'])) {
            return 'Username contains whitespace';
        }
          if (!empty($_POST['email']) && !preg_match($email_regex, $_POST['email'])) {
            $email_validate = 'Invalid Email';
          }
          else if (!empty($_POST['email']) && !empty($user_model->find_user_by_email($_POST['email']))) {
            $email_validate = 'Email already exists';
          }
          if (!empty($_POST['password']) && !empty($_POST['confirm-password']) && $_POST['password'] != $_POST['confirm-password']) {
            $password_validate = 'Password does not match';
            $confirm_password_validate = 'Password does not match';
          }
          response_json(array(
            "username" => $username_validate,
            "email" => $email_validate,
            "password" => $password_validate,
            "confirm-password" => $confirm_password_validate
          ));
          return;
          break;
        default:
          response_not_allowed_method();
          return;
          break;
      }
    }

    public function register(){
      switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
          $user_model = new UserModel();
          try {
            $hashed_password = hash_user_password($_POST['password']);
            $user_model->insert_user($_POST['username'], $_POST['email'], $hashed_password, 0);
          } catch (Exception $e) {
            $this->view("register/index", ["status_message" => INTERNAL_ERROR]);
          }
          $this->view("register/index", ["status_message" => SUCCESS]);
          return;
        default:
          response_not_allowed_method();
          return;
          break;
      }
    }
}