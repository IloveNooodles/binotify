<?php
require_once BASE_URL . '/src/interface/model/user.php';
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/interface/model/album.php';

class SearchService {
    public function search_all_user($page = 1) {
        $user_model = new UserModel();

        $data = $user_model->find_all_user($page);
        return $data;
    }

    public function search_all_song($page = 1) {
        $song_model = new SongModel();

        $data = $song_model->find_all_song($page);    
        return $data;
    }

    public function song() {
        
    }

    public function album() {

    }
}