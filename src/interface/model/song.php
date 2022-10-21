<?php

require_once $_ENV['PWD'] . '/infrastructure/database/mysql.php';
define('PAGINATION_LIMIT', 25);

class SongModel {
  private $db;

  public function __construct() {
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function find_all_song($page) {
    $query = "SELECT * From Song ORDER BY judul LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);

    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);

    $result = $this->db->result_set();
    return $result;
  }

  public function find_detail_song($id) {
    $query = "SELECT * FROM Song WHERE song_id = :id";

    $this->db->query($query);
    
    $result = $this->db->single();
    return $result;
  }

  public function find_song_by_judul($judul, $page) {
    $query = "SELECT * From Song WHERE judul LIKE '%:judul%' LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("judul", $judul);

    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_penyanyi($penyanyi, $page) {
    $query = "SELECT * From Song WHERE penyanyi LIKE '%:penyanyi%' LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("penyanyi", $penyanyi);

    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_tahun_terbit($tanggal_terbit, $page) {
    $query = "SELECT * From Song WHERE tanggal_terbit = :tanggal_terbit LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);

    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_album_id($album_id, $page) {
    $query = "SELECT * From Song WHERE album_id = :album_id LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("album_id", $album_id);

    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
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
  
}


?>