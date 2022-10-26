<?php
require_once BASE_URL . '/src/service/album/index.php';

class Album extends Controller {
    public function index() {
        $this->view('album/index');
    }

    public function detail() {
        $album_service = new AlbumService();
        $album = $album_service->detail($_GET['id']);
        $this->view('album/detail', $album);
    }

    public function new() {
        switch($_SERVER["REQUEST_METHOD"]){
            case "GET":
                $this->view("album/insert_album");
                break;
            case "POST":
                $album_service = new AlbumService();
                if (empty($_POST['judul']) || empty($_POST['penyanyi']) || empty($_POST['tanggal']) || empty($_POST['genre']) || empty($_FILES)) {
                    $data = ["status_message" => DATA_NOT_COMPLETE];
                    $this->view("album/insert_album", $data);
                }
                else {
                    $status = $album_service->new($_POST['judul'], $_POST['penyanyi'], $_POST['tanggal'], $_POST['genre'], $_FILES);
                    $data = ["status_message" => $status];
                    $this->view("album/insert_album", $data);
                }
                return;
                break;
        }
    }

    public function edit() {
        // mau edit apanya teuing
    }

    public function delete() {
        $album_service = new AlbumService();
        $status_message = $album_service->delete($_POST['id']);
        header("Location: /album" . $status_message);
    }

    // public function add_song() {
    //     // PAKE YG DI SONG CONTROLLER AJA (SAMA AJA)
    // }

    // public function delete_song() {
    //     // PAKE YG DI SONG CONTROLLER AJA (SAMA AJA)
    // }
}