<?php

require_once $_ENV['PWD'] . '/infrastructure/database/mysql.php';

class SongModel {
  private $db;

  public function __construct() {
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function find_song_by_judul($judul) {
    $query = "SELECT * From Song"
  }
}


?>