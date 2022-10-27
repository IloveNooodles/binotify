<?php
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/interface/storage/audio.php';
require_once BASE_URL . '/src/interface/storage/image.php';


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

    public function new($judul, $penyanyi, $tanggal_terbit, $genre, $file_image, $file_audio) {
        $total_duration = 0;
        
        try {
            $song_model = new SongModel();
            $audio_storage = new AudioStorage();
            $image_storage = new ImageStorage();

            if (!isset($file_image['name']) || !isset($file_image['tmp_name'])) {
                return DATA_NOT_COMPLETE;
            }
            if (!isset($file_audio['name']) || !isset($file_audio['tmp_name'])) {
                return DATA_NOT_COMPLETE;
            }

            $audio_path = $audio_storage->save_audio($file_audio['name'], $file_audio['tmp_name'], AUDIO_DIR);
            $image_path = $image_storage->save_image($file_image['name'], $file_image['tmp_name'], IMAGE_DIR);

            if ($audio_path == null || $image_path == null) {
                return INTERNAL_ERROR;
            }

            $total_duration = $audio_storage->get_audio_duration($audio_path);
            if ($total_duration == null || $total_duration <= 0) {
                return DATA_NOT_COMPLETE;
            }

            $song_model->insert_song($judul, $penyanyi, $tanggal_terbit, $total_duration, $genre, $audio_path, $image_path, null);
        } catch (Throwable $e) {
            return INTERNAL_ERROR;
        }
        return SUCCESS;
    }

    public function edit($song_id, $judul, $penyanyi, $tanggal_terbit, $genre, $file_image, $file_audio) {
        try {
            $song_model = new SongModel();
            $audio_storage = new AudioStorage();
            $image_storage = new ImageStorage();

            $cur_song = $song_model->find_detail_song($song_id);
            if ($cur_song == null) {
                return SONG_NOT_FOUND;
            }
            $audio = $cur_song['audio_path'];
            $cover = $cur_song['image_path'];
            $total_duration = $cur_song['total_duration'];

            if (isset($file_audio) && isset($file_audio['name']) && isset($file_audio['tmp_name'])) {
                $result = $audio_storage->save_audio($file_audio['name'], $file_audio['tmp_name'], AUDIO_DIR);
                if ($result == null) {
                    return INTERNAL_ERROR;
                }
                $audio = $result;
                $total_duration = $audio_storage->get_audio_duration($audio);
                if ($total_duration == null || $total_duration <= 0) {
                    return DATA_NOT_COMPLETE;
                }
            }
            if (isset($file_image) && isset($file_image['name']) && isset($file_image['tmp_name'])) {
                $result = $image_storage->save_image($file_image['name'], $file_image['tmp_name'], IMAGE_DIR);
                if ($result == null) {
                    return INTERNAL_ERROR;
                }
                $cover = $result;
            }

            $song_model->update_song($judul, $penyanyi, $tanggal_terbit, $total_duration, $genre, $audio, $cover, $song_id);
        } catch (Throwable $e) {
            return INTERNAL_ERROR;
        }
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