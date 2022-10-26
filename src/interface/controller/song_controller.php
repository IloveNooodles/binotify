<?php
require_once BASE_URL . '/src/service/song/index.php';

class Song extends Controller {
    public function index(){
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
            redirect_home();
            break;
            case "POST":
            break;
        }
    }

    public function detail() {
        
    }

    public function new() {
        $song_service = new SongService();
        if (empty($_POST['judul']) || empty($_POST['audio_path']) || empty($_POST['album_id'])) {
            $this->view("song/insert_song", ["status_message" => DATA_NOT_COMPLETE]);
        }
        else {
            $this->view("song/insert_song", $song_service->new($_POST['judul'], $_POST['audio_path'], $_POST['album_id']));
        }
        // belom tau redirect kemana
    }

    public function edit() {
        
    }

    public function delete() {
        $song_service = new SongService();
        $song_service->delete($_POST['id']);
        // belom tau redirect kemana
    }

    public function search() {
        $this->view("search/index");
    }
}