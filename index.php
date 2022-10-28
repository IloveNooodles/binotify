<?php	
require_once $_ENV['PWD'] . '/src/init.php';
if (!session_id() || session_status() == 0) {
  session_start();
  $_SESSION['num_song_played'] = 0;
  $_SESSION['limit_song'] = false;
};
$app = new App();