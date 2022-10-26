<?php
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/service/album/index.php';

class SongService {
    public function detail($id) {
        $song_model = new SongModel();
        $album_service = new AlbumService();
        $song = $song_model->find_detail_song($id);
        $album = $album_service->detail($song['album_id']);
        $data = [
            'song' => $song,
            'album' => $album
        ];
        return $data;
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

    public function search($res, $page, $genre, $sort) {
        $song_model = new SongModel();
        $songs = $song_model->find_song_by_judul_penyanyi_tahun_filter_by_genre($res, $page, $genre, $sort);
        return $songs;
    }

    public function get_genre() {
        $song_model = new SongModel();
        $genres = $song_model->get_all_genre();
        return $genres;
    }
}