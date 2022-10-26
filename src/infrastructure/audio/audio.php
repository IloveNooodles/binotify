<?php
define("MAX_UPLOAD_FILE_SIZE", 16000000);

function get_file_song_duration($song_path){
  $cmd = "mediainfo --Output='General;%Duration%' " . $song_path;
  $res = shell_exec($cmd);
  try {
    $res = intdiv($res, 1000);
    return $res;
  } catch (Throwable $e) {
    error_log('Song is not available!');
  }
  return -1;
}

function check_filename_exists($file_name) {
  if(file_exists($file_name)){
    return 0;
  }
  return 1;
}

function check_file_type($type){
  if($type != "audio/mp3" || $type != "audio/wav" ||$type != "audio/mpeg") {
    return 0;
  }
  return 1;
}

function check_max_size($size){
  if($size >= MAX_UPLOAD_FILE_SIZE) {
    return 0;
  }
  return 1;
}

?>