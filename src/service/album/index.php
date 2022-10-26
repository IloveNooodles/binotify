<?php
require_once BASE_URL . '/src/interface/model/album.php';
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/infrastructure/upload/upload.php';
require_once "utils/constant.php";

class AlbumService {
    public function detail($album_id) {
        $album_model = new AlbumModel();
        $album = $album_model->find_detail_album($album_id);
        return $album;
    }

    public function new($judul, $penyanyi, $tanggal_terbit, $genre, $files) {
        $total_duration = 0;
        $album_model = new AlbumModel();
        $filename = $_FILES['cover']['name'];
        $tmp_path = $_FILES['cover']['tmp_name'];
        $unique_name = generate_unique_name($filename);
        $file_ext = get_file_extension($filename);
        $unique_name = $unique_name . "." . $file_ext;
        $result = null;
        if(!filename_exists(TARGET_IMG, $unique_name)){
          $result = save_file($tmp_path, $unique_name, TARGET_IMG);
        }
        try {
            $album_model->insert_album($judul, $penyanyi, $tanggal_terbit, $total_duration, $genre, $result);
        } catch (Throwable $e) {
            return INTERNAL_ERROR;
        }
        return SUCCESS;
    }

    public function edit() {
    
    }

    public function delete($id) {
        $album_model = new AlbumModel();
        $song_model = new SongModel();
        try {
            $song_model->delete_song_by_album_id($id);
            $album_model->delete_album($id);
        } catch (Throwable $e) {
            return "?status-message=" . INTERNAL_ERROR;
        }
        return "?status-message=" . SUCCESS;
    }

    public function update_duration($id) {
    $song_model = new SongModel();
    $songs = $song_model->find_all_song_by_album_id($id);
    $total_duration = 0;
    foreach ($songs as $song) {
        $total_duration += $song['duration'];
        }
    $album_model = new AlbumModel();
    $album_model->update_album_duration($id, $total_duration);
    }
}