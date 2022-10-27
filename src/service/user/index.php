<?php
require_once BASE_URL . '/src/interface/model/user.php';

class UserService {
    public function detail($user_id) {
      $user_model = new UserModel();
      $user = $user_model->find_user_by_id($user_id);
      $resp = array();

      if(isset($user)){
        $resp['data'] = [];
        $resp['status_message'] = USER_NOT_FOUND;
        return $resp;
      }

    }

    public function register($email, $username, $password) {
      $user_model = new UserModel();
      
      
    }
}