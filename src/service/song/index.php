<?php
require_once BASE_DIR . '/src/interface/model/song.php';
require_once BASE_URL . '/src/service/album/index.php';

class SongService {
    public function detail() {

    }

    public function new($judul, $audio_path, $album_id) {
        $song_model = new SongModel();
        $album_service = new AlbumService();
        try {
            $duration = get_file_song_duration($audio_path);
            $album_detail = $album_service->detail($album_id);
            $song_model->insert_song($judul, $album_detail["penyanyi"], $album_detail["tanggal_terbit"], 
                                    $duration, $album_detail["genre"], $audio_path, $album_detail["image_path"], $album_id);
            $album_service->update_duration($album_id);
        } catch (Throwable $e) {
            return ["status_message" => INTERNAL_ERROR];
        }
        return ["status_message" => SUCCESS];
    }

    public function edit() {
        
    }

    public function delete() {
        $song_model = new SongModel();
        $album_service = new AlbumService();
        try {
            $song_model->delete_song_by_id($_POST['id']);
            $album_service->update_duration($_POST['album_id']);
        } catch (Throwable $e) {
            return ["status_message" => INTERNAL_ERROR];
        }
        return ["status_message" => SUCCESS];
    }
}