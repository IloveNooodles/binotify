<?php
require_once BASE_URL . "/src/infrastructure/file/file.php";

class ImageStorage {
    public function save_image($file_name, $tmp_path, $type){
        $file_infra = new File();
        $result = null;
    
        if (!$this->is_image_valid($file_name)) {
            return $result;
        }
    
        $unique_name = $this->generate_unique_name($file_name);
        $file_ext = $file_infra->get_file_extension($file_name);
        $unique_name = $unique_name . "." . $file_ext;
    
        if(!$file_infra->filename_exists($type, $unique_name)){
            $result = $file_infra->save_file($tmp_path, $unique_name, $type);
        }
        return $result;
    }
    
    private function is_image_valid($image_path) {
        $image_extension = pathinfo($image_path, PATHINFO_EXTENSION);
        $image_extension = strtolower($image_extension);
        $valid_image_extension = ["jpg", "jpeg", "png"];
        return in_array($image_extension, $valid_image_extension);
    }

    private function generate_unique_name($name){
        $unique_name = md5(rand()) . md5($name . rand()) . time();
        return $unique_name;
    }
}