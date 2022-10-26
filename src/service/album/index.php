<?php
require_once BASE_URL . '/src/interface/model/album.php';
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/infrastructure/audio/audio.php';
require_once "utils/constant.php";

class AlbumService {
    public function detail($album_id) {
        $album_model = new AlbumModel();
        $album = $album_model->find_detail_album($album_id);
        return $album;
    }

    public function new($judul, $penyanyi, $tanggal_terbit, $genre, $image_path) {
        $total_duration = 0;
        $album_model = new AlbumModel();
        try {
            $album_model->insert_album($judul, $penyanyi, $tanggal_terbit, $total_duration, $genre, $image_path);
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