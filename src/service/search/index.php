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

    public function search_song($word, $genre, $asc, $orderby, $page = 1) {
        $data = null;
        try {
            $song_model = new SongModel();

            $word_array = [];
            $word = trim($word);
            if ($word != '') {
                $word_array = explode(" ", $word);
            }

            $order = $asc ? "ASC" : "DESC";

            $songs = $song_model->search_song_per_word($word_array, $page, $genre, $order, $orderby);
            $data['songs'] = $songs;

            $count_row = $song_model->count_search_song_per_word($word_array, $genre, $order, $orderby);
            $total_page = ceil($count_row['total_row']/PAGINATION_LIMIT);

            $data['total_page'] = $total_page;
            $data['current_page'] = (int)$page;
        } catch (Throwable $e) {
            $data['status_message'] = INTERNAL_ERROR;
            return $data;
        }
        $data['status_message'] = SUCCESS;
        return $data;
    }
}