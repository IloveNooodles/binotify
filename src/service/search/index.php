<?php
require_once BASE_URL . '/src/interface/model/user.php';
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/interface/model/album.php';

class SearchService {
    public function user($page = 1) {
        $user_model = new UserModel();
        
        $data = $user_model->find_all_user($page);
        return $data;
    }

    public function song() {

    }

    public function album() {

    }
}
?>