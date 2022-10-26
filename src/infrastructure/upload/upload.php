<?php
define("MAX_UPLOAD_FILE_SIZE", 32000000);
define("TARGET_IMG", BASE_URL . "/public/img/");
define("TARGET_AUDIO", BASE_URL . "/public/audio/");

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

function save_image($file, $type){
  $result = null;
  $filename = $file['cover']['name'];
  $tmp_path = $file['cover']['tmp_name'];

  if (!is_image_valid($filename)) {
    return $result;
  }

  $unique_name = generate_unique_name($filename);
  $file_ext = get_file_extension($filename);
  $unique_name = $unique_name . "." . $file_ext;

  if(!filename_exists($type, $unique_name)){
    $result = save_file($tmp_path, $unique_name, $type);
  }
  return $result;
}

function is_image_valid($image_path) {
  $image_extension = pathinfo($image_path, PATHINFO_EXTENSION);
  $image_extension = strtolower($image_extension);
  $valid_image_extension = ["jpg", "jpeg", "png"];
  return in_array($image_extension, $valid_image_extension);
}

function is_audiovalid($audio_path){
  $audio_extension = pathinfo($audio_path, PATHINFO_EXTENSION);
  $audio_extension = strtolower($audio_extension);
  $valid_audio_extension = ["jpg", "jpeg", "png"];
  return in_array($audio_extension, $valid_audio_extension);
}