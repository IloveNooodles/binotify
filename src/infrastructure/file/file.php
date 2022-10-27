<?php

class File {
    public function __construct() {
    }

    public function filename_exists($extension, $file_name) {
        $file_path = $extension . $file_name;
        if(file_exists($file_path)){
            return true;
        }
        return false;
    }

    public function get_file_extension($file_name){
        return pathinfo($file_name, PATHINFO_EXTENSION);
    }

    public function save_file($tmp_path, $filename, $type){
        $file_path = $type . $filename;
        move_uploaded_file($tmp_path, $file_path);
        return $file_path;
    }
}