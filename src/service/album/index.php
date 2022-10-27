<?php
require_once BASE_URL . '/src/interface/model/album.php';
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/interface/storage/image.php';

class AlbumService {
    public function detail($album_id) {
        $data = [];

        $album_model = new AlbumModel();
        $album = $album_model->find_detail_album($album_id);
        $data['album'] = $album;

        $song_model = new SongModel();
        $songs = $song_model->find_all_songs_by_album_id($album_id);
        $data['songs'] = $songs;

        return $data;
    }

    public function new($judul, $penyanyi, $tanggal_terbit, $genre, $file_image) {
        $total_duration = 0;

        try {
            $album_model = new AlbumModel();
            $image_storage = new ImageStorage();

            if (!isset($file_image['name']) || !isset($file_image['tmp_name'])) {
                return DATA_NOT_COMPLETE;
            }

            $image_path = $image_storage->save_image($file_image['name'], $file_image['tmp_name'], IMAGE_DIR);
            if ($image_path == null) {
                return INTERNAL_ERROR;
            }

            $album_model->insert_album($judul, $penyanyi, $tanggal_terbit, $total_duration, $genre, $image_path);
        } catch (Throwable $e) {
            return INTERNAL_ERROR;
        }
        return SUCCESS;
    }

    public function edit($album_id, $judul, $penyanyi, $tanggal_terbit, $genre, $file_image) {
        try {
            $album_model = new AlbumModel();
            $image_storage = new ImageStorage();

            $cur_album = $album_model->find_detail_album($album_id);
            if ($cur_album == null) {
                return ALBUM_NOT_FOUND;
            }
            $cover = $cur_album['image_path'];
            if (isset($file_image) && isset($file_image['name']) && isset($file_image['tmp_name'])) {
                $result = $image_storage->save_image($file_image['name'], $file_image['tmp_name'], IMAGE_DIR);
                if ($result == null) {
                    return INTERNAL_ERROR;
                }
                $cover = $result;
            }

            $album_model->update_album($judul, $penyanyi, $tanggal_terbit, $cur_album['total_duration'], $genre, $cover, $album_id);
        } catch (Throwable $e) {
            return INTERNAL_ERROR;
        }
        return SUCCESS;
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
        $album_model = new AlbumModel();
        try {
            $songs = $song_model->find_all_song_by_album_id($id);

            $total_duration = 0;
            foreach ($songs as $song) {
                $total_duration += $song['duration'];
            }

            $album_model->update_album_duration($id, $total_duration);
        } catch (Throwable $e) {
            return INTERNAL_ERROR;
        }
    }

    public function getAlbums($page) {
        $album_model = new AlbumModel();
        $data = $album_model->find_all_album($page);
        return $data;
    }
}