<?php
require_once BASE_URL . "/src/infrastructure/cmd/cmd.php";
require_once BASE_URL . "/src/infrastructure/file/file.php";

class AudioStorage {
    public function __construct() {
    }

    public function save_audio($file_name, $tmp_path, $type){
        $file_infra = new File();
        $result = null;
    
        if (!$this->is_audio_valid($file_name)) {
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

    public function get_audio_duration($audio_path){
        $cmd = new Cmd();
        $audio_duration_cmd = "mediainfo --Output='General;%Duration%' " . $audio_path;
        $audio_duration = $cmd->exec_command($audio_duration_cmd);
        try {
            $audio_duration = intdiv($audio_duration, 1000);
            return $audio_duration;
        } catch (Throwable $e) {
            error_log('Audio is not available!');
        }
        return -1;
    }

    private function is_audio_valid($audio_path){
        $audio_extension = pathinfo($audio_path, PATHINFO_EXTENSION);
        $audio_extension = strtolower($audio_extension);
        $valid_audio_extension = ["jpg", "jpeg", "png"];
        return in_array($audio_extension, $valid_audio_extension);
    }

    private function generate_unique_name($name){
        $unique_name = md5(rand()) . md5($name . rand()) . time();
        return $unique_name;
    }
}