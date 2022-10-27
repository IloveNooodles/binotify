<?php
require_once BASE_URL . '/src/service/album/index.php';

class Album extends Controller {
    public function index() {
        $album_service = new AlbumService();
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $data = $album_service->getAlbums($page);
        $this->view('album/index', $data);
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
                $data = NULL;
                if (empty($_POST['judul']) || empty($_POST['penyanyi']) || empty($_POST['tanggal']) || empty($_POST['genre']) || !isset($_FILES['cover'])) {
                    $data = ["status_message" => DATA_NOT_COMPLETE];
                }
                else {
                    $status = $album_service->new($_POST['judul'], $_POST['penyanyi'], $_POST['tanggal'], $_POST['genre'], $_FILES['cover']);
                    $data = ["status_message" => $status];
                }
                response_json($data);
                // $this->view("album/insert_album", $data);
                return;
                break;
        }
    }

    public function edit() {
        switch($_SERVER["REQUEST_METHOD"]){
            case "GET":
                $album_service = new AlbumService();
                $album = $album_service->detail($_GET['id']);
                $this->view("album/edit_album", $album);
                break;
            case "POST":
                $album_service = new AlbumService();
                if (empty($_POST['album_id'] || $_POST['judul']) || empty($_POST['penyanyi']) || empty($_POST['tanggal']) || empty($_POST['genre'])) {
                    $data = ["status_message" => DATA_NOT_COMPLETE];
                }
                else {
                    $cover = isset($_FILES['cover']) ? $_FILES['cover'] : null;

                    $status = $album_service->edit($_POST['album_id'], $_POST['judul'], $_POST['penyanyi'], $_POST['tanggal'], $_POST['genre'], $cover);
                    $data = ["status_message" => $status];
                }
                response_json($data);
                // $this->view("album/edit_album", $data);
                return;
                break;
        }
    }

    public function delete() {
        $album_service = new AlbumService();
        $status_message = $album_service->delete($_POST['id']);
        header("Location: /album" . $status_message);
    }
}