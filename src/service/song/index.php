<?php
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/interface/storage/audio.php';
require_once BASE_URL . '/src/interface/storage/image.php';
class SongService {
    public function detail($id) {
        try {
            $song_model = new SongModel();
            $album_service = new AlbumService();
            $song = $song_model->find_detail_song($id);
            if (!isset($song) or $song == null) {
                $data['status_message'] = SONG_NOT_FOUND;
                return $data;
            }

            $album = $album_service->detail($song['album_id']);
            if (!isset($album) or $album == null) {
                $data['status_message'] = ALBUM_NOT_FOUND;
                return $data;
            }

            $data['status_message'] = SUCCESS;
            $data = [
                'song' => $song,
                'album' => $album,
            ];
            return $data;
        } catch (Exception $e) {
            $data['status_message'] = INTERNAL_ERROR;
            return $data;
        }
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

    public function new_premium($file_audio) {
        $res = [];
        
        try {
            $audio_storage = new AudioStorage();

            if (!isset($file_audio['name']) || !isset($file_audio['tmp_name'])) {
                $res['status_message'] = DATA_NOT_COMPLETE;
                return $res;
            }

            $audio_path = $audio_storage->save_audio($file_audio['name'], $file_audio['tmp_name'], AUDIO_DIR);

            if ($audio_path == null) {
                $res['status_message'] = INTERNAL_ERROR;
                return $res;
            }

            $res = [
                'status_message' => SUCCESS,
                'audio_path' => $audio_path,
            ];
            return $res;
        } catch (Throwable $e) {
            $res['status_message'] = INTERNAL_ERROR;
            return $res;
        }
        return $res;
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
            $album_id = $cur_song['album_id'];
            $audio = $cur_song['audio_path'];
            $cover = $cur_song['image_path'];
            $total_duration = $cur_song['duration'];

            if (isset($file_audio) && isset($file_audio['name']) && isset($file_audio['tmp_name']) && $file_audio['name'] != "" && $file_audio['tmp_name'] != "") {
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
            if (isset($file_image) && isset($file_image['name']) && isset($file_image['tmp_name']) && $file_image['name'] != "" && $file_image['tmp_name'] != "") {
                $result = $image_storage->save_image($file_image['name'], $file_image['tmp_name'], IMAGE_DIR);
                if ($result == null) {
                    return INTERNAL_ERROR;
                }
                $cover = $result;
            }

            $song_model->update_song($song_id, $judul, $penyanyi, $tanggal_terbit, $total_duration, $genre, $audio, $cover, $album_id);
        } catch (Throwable $e) {
            return INTERNAL_ERROR;
        }
        return SUCCESS;
    }

    public function delete($song_id) {
        try {
            $song_model = new SongModel();
            $album_model = new AlbumModel();

            $cur_song = $song_model->find_detail_song($song_id);
            if ($cur_song == null) {
                $data['status_message'] = SONG_NOT_FOUND;
                return SONG_NOT_FOUND;
            }

            $song_duration = $cur_song['duration'];
            $album_id = $cur_song['album_id'];

            $song_model->delete_song_by_id($song_id);
            if (!isset($album_id) or $album_id == null) {
                $data['status_message'] = SUCCESS;
                return SUCCESS;
            }

            $cur_album = $album_model->find_detail_album($album_id);
            if ($cur_album == null) {
                $data['status_message'] = SUCCESS;
                return SUCCESS;
            }

            $new_album_total_duration = $cur_album['total_duration'] - $song_duration;

            $album_model->update_album_duration($album_id, $new_album_total_duration);
        } catch (Throwable $e) {
            $data['status_message'] = INTERNAL_ERROR;
            return INTERNAL_ERROR;
        }
        $data['status_message'] = SUCCESS;
        return SUCCESS;
    }

    public function all_distinct_genre() {
        $song_model = new SongModel();
        $data['genre'] = $song_model->all_distinct_genre();
        return $data;
    }

    public function delete_song_from_album($song_id) {
        $data = null;
        try {
            $song_model = new SongModel();
            $album_model = new AlbumModel();

            $cur_song = $song_model->find_detail_song($song_id);
            if ($cur_song == null) {
                $data['status_message'] = SONG_NOT_FOUND;
                return $data;
            }

            $song_duration = $cur_song['duration'];
            $album_id = $cur_song['album_id'];

            $song_model->delete_album_id_from_song($song_id);
            if (!isset($album_id) or $album_id == null) {
                $data['status_message'] = SUCCESS;
                $data['album_id'] = $album_id;
                return $data;
            }

            $cur_album = $album_model->find_detail_album($album_id);
            if ($cur_album == null) {
                $data['status_message'] = SUCCESS;
                $data['album_id'] = $album_id;
                return $data;
            }

            $new_album_total_duration = $cur_album['total_duration'] - $song_duration;

            $album_model->update_album_duration($album_id, $new_album_total_duration);
        } catch (Throwable $e) {
            $data['status_message'] = INTERNAL_ERROR;
            $data['album_id'] = $album_id;
            return INTERNAL_ERROR;
        }
        $data['status_message'] = SUCCESS;
        $data['album_id'] = $album_id;
        return $data;
    }

    public function add_song_to_album($song_id, $album_id) {
        $data = null;
        try {
            $song_model = new SongModel();
            $album_model = new AlbumModel();

            $cur_song = $song_model->find_detail_song($song_id);
            if ($cur_song == null) {
                $data['status_message'] = SONG_NOT_FOUND;
                return $data;
            }

            if ($cur_song['album_id'] != null) {
                $data['status_message'] = ALBUM_SONG_NOT_NULL;
                return $data;
            }

            $cur_album = $album_model->find_detail_album($album_id);
            if ($cur_album == null) {
                $data['status_message'] = ALBUM_NOT_FOUND;
                return $data;
            }

            $song_duration = $cur_song['duration'];
            $new_album_total_duration = $cur_album['total_duration'] + $song_duration;

            $song_model->update_album_id($song_id, $album_id);
            $album_model->update_album_duration($album_id, $new_album_total_duration);
        } catch (Throwable $e) {
            $data['status_message'] = INTERNAL_ERROR;
            return $data;
        }
        $data['status_message'] = SUCCESS;
        return $data;
    }

    public function get_unlinked_song($album_id) {
        $data = null;
        try {
            $song_model = new SongModel();
            $album_model = new AlbumModel();

            $cur_album = $album_model->find_detail_album($album_id);
            if ($cur_album == null) {
                $data['status_message'] = ALBUM_NOT_FOUND;
                return $data;
            }

            $cur_singer = $cur_album['penyanyi'];

            $data['songs'] = $song_model->find_unlinked_song_by_singer($cur_singer);
        } catch (Throwable $e) {
            $data['status_message'] = INTERNAL_ERROR;
            return $data;
        }
        return $data;
    }

    public function get_song_where_album_is_null(){
        $data = null;
        try {
            $song_model = new SongModel();
            $res = $song_model->find_song_by_null();
            $data['songs'] = $res;
            return $data;
        } catch (Throwable $e) {
            $data['status_message'] = INTERNAL_ERROR;
            return $data;
        }
        return $data;

    }
}