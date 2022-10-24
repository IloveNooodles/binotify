<?php

function get_file_song_duration($song){
  $cmd = "mediainfo --Output='General;%Duration%' /var/www/html/public/audio/" . $song;
  $res = shell_exec($cmd);
  try {
    $res = intdiv($res, 1000);
    return $res;
  } catch (Throwable $e) {
    error_log('Song is not available!');
  }
  return -1;
}

?>