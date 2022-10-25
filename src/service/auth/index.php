<?php
require_once $_ENV['PWD'] . '/src/interface/model/user.php';
require_once $_ENV['PWD'] . '/src/infrastructure/password/password.php';
require_once "utils/constant.php";

class AuthService {
    public function login($username, $password) {
      $user_model = new UserModel();

      if (preg_match('/\s/', $username)) {
          return USERNAME_CONTAINS_WHITESPACE;
      }

      $user = $user_model->find_user_by_username($username);
  
      /* if user doesn't exists */
      if(!isset($user)){
        return USER_NOT_FOUND;
      }

      if(!check_password($password, $user['password'])){
        return WRONG_PASSWORD;
      }

      $_SESSION['username'] = $username;
      $role = "user";
      /* if its admin */ 
      if($user['isAdmin']) {
        $role = "admin"; 
      }
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['role'] = $role;

      return SUCCESS;
    }

    public function logout() {
      session_unset();
      session_destroy();

      return SUCCESS;
    }
}