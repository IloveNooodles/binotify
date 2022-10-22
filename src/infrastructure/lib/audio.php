<?php

function get_file_song_duration($song){
  $cmd = "mediainfo --Output='General;%Duration%' " . $song;
  $res = shell_exec($cmd);
  try {
    $res = intdiv($res, 1000);
    return $res;
  } catch (Throwable $e) {
  }
  return -1;
}

?>