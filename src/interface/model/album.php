<?php

require_once $_ENV['PWD'] . '/infrastructure/database/mysql.php';
define('PAGINATION_LIMIT', 25);


class AlbumModel {
  private $db;

  public function __construct(){
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function find_all_album($page){
    $query = "SELECT * From Album ORDER BY judul LIMIT PAGINATION_LIMIT OFFSET :offset";

    $this->db->query($query);

    if(!isset($page) || isset($page) && $page <= 0){
      $page = 1;
    }

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);

    $result = $this->db->result_set();
    return $result;
  }

  public function find_detail_album($album_id){
    $query = "SELECT * From Album LIMIT WHERE album_id = :album_id";

    $this->db->query($query);
    $this->db->bind("album_id", $album_id);

    $result = $this->db->single();
    return $result;
  }

  public function find_album_by_judul($judul, $page) {
    $query = "SELECT * From Album WHERE judul LIKE '%:judul%' LIMIT PAGINATION_LIMIT OFFSET :offset";

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

  public function find_album_by_penyanyi($penyanyi, $page) {
    $query = "SELECT * From Album WHERE penyanyi LIKE '%:penyanyi%' LIMIT PAGINATION_LIMIT OFFSET :offset";

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

  public function find_album_by_tahun_terbit($tanggal_terbit, $page) {
    $query = "SELECT * From Album WHERE tanggal_terbit = :tanggal_terbit LIMIT PAGINATION_LIMIT OFFSET :offset";

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

  public function insert_album($judul, $penyanyi, $tanggal_terbit, $total_duration, $genre, $audio_path, $image_path) {
    $query = "INSERT INTO Album (judul, penyanyi, tanggal_terbit, total_duration, genre, image_path) 
    VALUES (:judul, :penyanyi, :tanggal_terbit, :total_duration, :genre, :image_path)";

    $this->db->query($query);
    $this->db->bind("judul", $judul);
    $this->db->bind("penyanyi", $penyanyi);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);
    $this->db->bind("total_duration", $total_duration);
    $this->db->bind("genre", $genre);
    $this->db->bind("image_path", $image_path);

    $this->db->execute();
  }

  public function update_album($judul, $penyanyi, $tanggal_terbit, $total_duration, $genre, $audio_path, $image_path, $album_id) {
    $query = "UPDATE Album SET judul = :judul, penyanyi = :penyanyi, tanggal_terbit = :tanggal_terbit, total_duration = :total_duration, genre = :genre, image_path = :image_path WHERE album_id = :album_id";

    $this->db->query($query);
    $this->db->bind("judul", $judul);
    $this->db->bind("penyanyi", $penyanyi);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);
    $this->db->bind("total_duration", $total_duration);
    $this->db->bind("genre", $genre);
    $this->db->bind("image_path", $image_path);
    $this->db->bind("album_id", $album_id);

    $this->db->execute();
  }

  public function delete_album($album_id){
    $query = "DELETE FROM Album WHERE album_id = :album_id";

    $this->db->query($query);
    $this->db->bind("album_id", $album_id);

    $this->db->execute();
  }
}

?>