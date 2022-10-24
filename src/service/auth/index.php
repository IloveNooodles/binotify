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
      if($user == null){
        return USER_NOT_FOUND;
      }

      if(!check_password($password, $user['password'])){
        return WRONG_PASSWORD;
      }

      $_SESSION['username'] = $username;
      $_SESSION['name'] = $user['name'];
      $_SESSION['role'] = $user['role'];

      return SUCCESS;
    }

    public function logout() {

    }
}
?>