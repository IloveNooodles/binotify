<?php
define("MAX_UPLOAD_FILE_SIZE", 32000000);
define("TARGET_IMG", "/var/www/html/public/img/");
define("TARGET_AUDIO", "/var/www/html/public/audio/");

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

function filename_exists($extension, $file_name) {
  $file_path = $extension . $file_name;
  if(file_exists($file_path)){
    return true;
  }
  return false;
}

function check_file_type($type, $list){
  if($type != "audio/mp3" || $type != "audio/wav" ||$type != "audio/mpeg") {
    return true;
  }
  return false;
}

function is_above_max_size($size){
  if($size >= MAX_UPLOAD_FILE_SIZE) {
    return true;
  }
  return false;
}

function generate_unique_name($name){
  $unique_name = md5(rand()) . md5($name . rand()) . time();
  return $unique_name;
}

function get_file_extension($name){
  $splitted_name = explode(".", $name);
  $ext = end($splitted_name);
  return $ext;
}

function save_file($tmp_path, $filename, $type){
  $file_path = $type . $filename;
  move_uploaded_file($tmp_path, $file_path);
  return $file_path;
}