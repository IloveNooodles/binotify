<?php

require_once BASE_URL . '/src/infrastructure/database/mysql.php';

class AlbumModel {
  private $db;

  public function __construct(){
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function find_all_album($page, $order = 'ASC', $orderby = 'judul', $limit = PAGINATION_LIMIT){
    $query = "SELECT * From Album ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_all_album_filter_by_genre($page, $order = 'ASC', $orderby = 'judul', $genre, $limit = PAGINATION_LIMIT){
    $query = "SELECT * From Album WHERE genre = :genre ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $this->db->bind("genre", $genre);

    $result = $this->db->result_set();
    return $result;
  }

  public function find_detail_album($album_id){
    $query = "SELECT * From Album WHERE album_id = :album_id";

    $this->db->query($query);
    $this->db->bind("album_id", $album_id);

    $result = $this->db->single();
    return $result;
  }

  public function find_album_by_judul($judul, $page, $order = 'ASC', $orderby = 'judul', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Album WHERE judul LIKE '%$judul%' ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
  
    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_album_by_judul_filter_by_genre($judul, $page, $order = 'ASC', $orderby = 'judul', $genre, $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Album WHERE judul LIKE '%$judul%' AND genre = :genre ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("genre", $genre);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_album_by_penyanyi($penyanyi, $page, $order = 'ASC', $orderby = 'judul', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Album WHERE penyanyi LIKE '%$penyanyi%' ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_album_by_penyanyi_filter_by_genre($penyanyi, $page, $order = 'ASC', $orderby = 'judul', $genre, $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Album WHERE penyanyi LIKE '%$penyanyi%' AND genre = :genre ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("genre", $genre);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_album_by_tahun_terbit($tanggal_terbit, $page, $order = 'ASC', $orderby = 'judul', $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Album WHERE tanggal_terbit = :tanggal_terbit ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);

    $offset = ($page - 1) * PAGINATION_LIMIT;
    $this->db->bind("offset", $offset);
    $result = $this->db->result_set();
    return $result;
  }

  public function find_album_by_tahun_terbit_filter_by_genre($tanggal_terbit, $page, $order = 'ASC', $orderby = 'judul', $genre, $limit = PAGINATION_LIMIT) {
    $query = "SELECT * From Album WHERE tanggal_terbit = :tanggal_terbit AND genre = :genre ORDER BY $orderby $order LIMIT $limit OFFSET :offset";

    $this->db->query($query);
    $this->db->bind("tanggal_terbit", $tanggal_terbit);
    $this->db->bind("genre", $genre);

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