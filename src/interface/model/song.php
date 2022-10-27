<?php

require_once BASE_URL . '/src/infrastructure/database/mysql.php';

class SongModel {
  private $db;

  public function __construct() {
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function find_all_song($page, $orderby = 'song_id', $order = 'DESC', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    
    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);

    $result = $this->db->result_set();
    return $result;
  }

  public function find_all_song_filter_by_genre($page, $genre, $orderby = 'song_id', $order = 'DESC', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song WHERE genre = :genre ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $this->db->bind("genre", $genre);

    $result = $this->db->result_set();
    return $result;
  }

  public function find_detail_song($id) {
    $query = "SELECT * FROM Song WHERE song_id = :id";

    $this->db->query($query);

    $this->db->bind("id", $id);

    $result = $this->db->single();
    return $result;
  }

  public function find_song_by_judul($judul, $page, $order = 'DESC', $orderby = 'song_id', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song WHERE judul LIKE '%$judul%' ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

   public function find_song_by_judul_filter_by_genre($judul, $page, $genre, $order = 'DESC', $orderby = 'song_id', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song WHERE judul LIKE '%$judul%' AND genre = :genre ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("genre", $genre);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_penyanyi($penyanyi, $page, $order = 'DESC', $orderby = 'song_id', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song WHERE penyanyi LIKE '%$penyanyi%' ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    
    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_penyanyi_filter_by_genre($penyanyi, $page, $genre, $order = 'DESC', $orderby = 'song_id',  $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song WHERE penyanyi LIKE '%$penyanyi%' AND genre = :genre ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("genre", $genre);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_tahun_terbit($tanggal_terbit, $page, $order = 'DESC', $orderby = 'song_id', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song WHERE tanggal_terbit = :tanggal_terbit ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

    public function find_song_by_tahun_terbit_filter_by_genre($tanggal_terbit, $page, $genre, $order = 'DESC', $orderby = 'song_id', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song WHERE tanggal_terbit = :tanggal_terbit AND genre = :genre ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);
    $this->db->bind("genre", $genre);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_all_songs_by_album_id($album_id) {
    $query = "SELECT * FROM Song WHERE album_id = :album_id";

    $this->db->query($query);

    $this->db->bind("album_id", $album_id);

    $result = $this->db->result_set();
    return $result;
  }

  public function find_songs_by_album_id($album_id, $page, $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Song WHERE album_id = :album_id LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("album_id", $album_id);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_all_song_by_album_id($album_id) {
    $query = "SELECT * From Song WHERE album_id = :album_id";

    $this->db->query($query);
    $this->db->bind("album_id", $album_id);

    $result = $this->db->result_set();
    return $result;
  }

  public function insert_song($judul, $penyanyi, $tanggal_terbit, $duration, $genre, $audio_path, $image_path, $album_id) {
    $query = "INSERT INTO Song (judul, penyanyi, tanggal_terbit, duration, genre, audio_path, image_path, album_id) 
    VALUES (:judul, :penyanyi, :tanggal_terbit, :duration, :genre, :audio_path, :image_path, :album_id)";

    $this->db->query($query);
    $this->db->bind("judul", $judul);
    $this->db->bind("penyanyi", $penyanyi);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);
    $this->db->bind("duration", $duration);
    $this->db->bind("genre", $genre);
    $this->db->bind("audio_path", $audio_path);
    $this->db->bind("image_path", $image_path);
    $this->db->bind("album_id", $album_id);

    $this->db->execute();
  }

  public function update_song($song_id, $judul, $penyanyi, $tanggal_terbit, $duration, $genre, $audio_path, $image_path, $album_id) {
    $query = "UPDATE Song SET judul = :judul, penyanyi = :penyanyi, tanggal_terbit = :tanggal_terbit, duration = :duration, genre = :genre, audio_path = :audio_path, image_path = :image_path, album_id = :album_id WHERE song_id = :song_id";

    $this->db->query($query);
    $this->db->bind("song_id", $song_id);
    $this->db->bind("judul", $judul);
    $this->db->bind("penyanyi", $penyanyi);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);
    $this->db->bind("duration", $duration);
    $this->db->bind("genre", $genre);
    $this->db->bind("audio_path", $audio_path);
    $this->db->bind("image_path", $image_path);
    $this->db->bind("album_id", $album_id);

    $this->db->execute();
  }

  public function delete_song_by_id($song_id) {
    $query = "DELETE FROM Song WHERE song_id = :song_id";

    $this->db->query($query);
    $this->db->bind("song_id", $song_id);

    $this->db->execute();
  }

  public function delete_song_by_album_id($album_id) {
    $query = "DELETE FROM Song WHERE album_id = :album_id";

    $this->db->query($query);
    $this->db->bind("album_id", $album_id);

    $this->db->execute();
  }

  public function search_song_per_word($word, $page = 1, $genre = 'all', $order = 'ASC', $orderby = 'judul', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * FROM Song ";
    $contain_genre = false;

    if (isset($genre) and !empty($genre) and $genre != 'all') {
      $query .= "WHERE genre = :genre ";
      $contain_genre = true;
    }

    if (isset($word) and !empty($word) and count($word) > 0) {
      $count_word = count($word);
      if (strpos($query, 'WHERE') !== false) {
        $query .= "AND ";
      } else {
        $query .= "WHERE ";
      }

      foreach(range(0, $count_word-1) as $i) {
        $w = $word[$i];
        $query .= "((LOWER(judul) LIKE LOWER('%$w%')) OR (LOWER(penyanyi) LIKE LOWER('%$w%')) OR (LOWER(tanggal_terbit) LIKE LOWER('%$w%'))) ";
        if($i != $count_word-1) {
          $query .= "AND ";
        }
      }
    }

    $query .= "ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->query($query);
    $this->db->bind("offset", $offset);
    if (isset($genre) and !empty($genre) and $contain_genre) {
      $this->db->bind("genre", $genre);
    }

    $result = $this->db->result_set();
    return $result;
  }
  
  public function count_all_song() {
    $query = "SELECT COUNT(*) as total FROM Song";
    $this->db->query($query);
    $result = $this->db->single();
    return $result;
  }
}