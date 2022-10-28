<?php
require_once BASE_URL . '/src/interface/model/album.php';
require_once BASE_URL . '/src/interface/model/song.php';
require_once BASE_URL . '/src/interface/storage/image.php';

class AlbumService {
    public function detail($album_id) {
        try {
            $data = [];

            $album_model = new AlbumModel();
            $album = $album_model->find_detail_album($album_id);
            $data['album'] = $album;
            if (!isset($album) or $album == null) {
                $data['status_message'] = ALBUM_NOT_FOUND;
                return $data;
            }

            $tanggal_terbit = $album['tanggal_terbit'];
            $year = date('Y', strtotime($tanggal_terbit));
            $data['album']['tahun_terbit'] = $year;

            $songs = $this->find_all_song_from_album_id($album_id);
            $data['songs'] = $songs;
            $total_song = count($songs);
            // add songs or song after total song
            $total_song = ($total_song > 1) ? $total_song . " songs" : $total_song . " song";
            $data['total_song'] = $total_song;

            $data['status_message'] = SUCCESS;
            return $data;
        } catch (Exception $e) {
            $data['status_message'] = INTERNAL_ERROR;
            return $data;
        }
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
            if (isset($file_image) && isset($file_image['name']) && isset($file_image['tmp_name']) && $file_image['name'] != '' && $file_image['tmp_name'] != '') {
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
        return SUCCESSS;
    }

    public function delete($id) {
        $data = null;
        try {
            $album_model = new AlbumModel();
            $song_model = new SongModel();

            $songs = $this->find_all_song_from_album_id($id);

            if ($songs != null) {
                foreach ($songs as $song) {
                    $song_model->delete_album_id_from_song($song['song_id']);
                }
            }

            $album_model->delete_album($id);
        } catch (Throwable $e) {
            $data['status_message'] = INTERNAL_ERROR;
            return $data;
        }
        $data['status_message'] = SUCCESS;
        return $data;
    }

    public function update_duration($id) {
        $song_model = new SongModel();
        $album_model = new AlbumModel();
        try {
            $songs = $song_model->find_all_songs_by_album_id($id);

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

        // add tahun_terbit to songs
        foreach ($data as $key => $album) {
            $tanggal_terbit = $album['tanggal_terbit'];
            $year = date('Y', strtotime($tanggal_terbit));
            $data[$key]['tahun_terbit'] = $year;
        }

        return $data;
    }

    private function find_all_song_from_album_id($album_id) {
        $song_model = new SongModel();
        $songs = $song_model->find_all_songs_by_album_id($album_id);

        return $songs;
    }
}