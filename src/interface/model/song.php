<?php

require_once $_ENV['PWD'] . '/infrastructure/database/mysql.php';
define('PAGINATION_LIMIT', 25);

class SongModel {
  private $db;

  public function __construct() {
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function find_all_song($page, $order, $orderby) {
    $query = "SELECT * From Song ORDER BY $order $orderby LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    /* TODO: Pindahin logic ini ke service */
    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }
    
    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $this->db->bind("order", $order);
    $this->db->bind("orderby", $orderby);

    $result = $this->db->result_set();
    return $result;
  }

  public function find_all_song_filter_by_genre($page, $order, $orderby, $genre) {
    $query = "SELECT * From Song WHERE genre = ':genre' ORDER BY :order :orderby LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    
    /* TODO: Pindahin logic ini ke service */
    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $this->db->bind("order", $order);
    $this->db->bind("orderby", $orderby);
    $this->db->bind("genre", $genre);

    $result = $this->db->result_set();
    return $result;
  }

  public function find_detail_song($id) {
    $query = "SELECT * FROM Song WHERE song_id = :id";

    $this->db->query($query);
    
    $result = $this->db->single();
    return $result;
  }

  public function find_song_by_judul($judul, $page, $order, $orderby) {
    $query = "SELECT * From Song WHERE judul LIKE '%:judul%' ORDER BY :order :orderby LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("judul", $judul);
    $this->db->bind("order", $order);
    $this->db->bind("orderby", $orderby);

    /* TODO: Pindahin logic ini ke service */
    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

   public function find_song_by_judul_filter_by_genre($judul, $page, $order, $orderby, $genre) {
    $query = "SELECT * From Song WHERE judul LIKE '%:judul%' AND genre = ':genre' ORDER BY :order :orderby LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("judul", $judul);
    $this->db->bind("order", $order);
    $this->db->bind("orderby", $orderby);
    $this->db->bind("genre", $genre);

    /* TODO: Pindahin logic ini ke service */
    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_penyanyi($penyanyi, $page, $order, $orderby) {
    $query = "SELECT * From Song WHERE penyanyi LIKE '%:penyanyi%' ORDER BY :order :orderby LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("penyanyi", $penyanyi);
    $this->db->bind("order", $order);
    $this->db->bind("orderby", $orderby);

    /* TODO: Pindahin logic ini ke service */
    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }
    
    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_penyanyi_filter_by_genre($penyanyi, $page, $order, $orderby, $genre) {
    $query = "SELECT * From Song WHERE penyanyi LIKE '%:penyanyi%' AND genre = ':genre' ORDER BY :order :orderby LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("penyanyi", $penyanyi);
    $this->db->bind("order", $order);
    $this->db->bind("orderby", $orderby);
    $this->db->bind("genre", $genre);

    /* TODO: Pindahin logic ini ke service */
    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_song_by_tahun_terbit($tanggal_terbit, $page, $order, $orderby) {
    $query = "SELECT * From Song WHERE tanggal_terbit = ':tanggal_terbit' ORDER BY :order :orderby LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("order", $order);
    $this->db->bind("orderby", $orderby);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);

        /* TODO: Pindahin logic ini ke service */

    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

    public function find_song_by_tahun_terbit_filter_by_genre($tanggal_terbit, $page, $order, $orderby, $genre) {
    $query = "SELECT * From Song WHERE tanggal_terbit = ':tanggal_terbit' AND genre = ':genre' ORDER BY :order :orderby LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);
    $this->db->bind("order", $order);
    $this->db->bind("orderby", $orderby);
    $this->db->bind("genre", $genre);

        /* TODO: Pindahin logic ini ke service */
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

    /* TODO: Pindahin logic ini ke service */
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