

<?php
define("MAX_UPLOAD_FILE_SIZE", 16000000);
// define("DIR")

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

// function

?>