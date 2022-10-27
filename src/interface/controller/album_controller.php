<?php
require_once BASE_URL . '/src/service/album/index.php';

class Album extends Controller {
    public function index() {
        switch($_SERVER["REQUEST_METHOD"]){
            case "GET":
                $album_service = new AlbumService();
                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                $data = $album_service->getAlbums($page);
                $this->view('album/index', $data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function detail($id = -1) {
        switch($_SERVER["REQUEST_METHOD"]){
            case "GET":
                $album_service = new AlbumService();

                if ($id == -1) {
                    $page = 1;
                    $data = $album_service->getAlbums($page);
                    $this->view('album/index', $data);
                    return;
                }

                $data = $album_service->detail($id);

                if (isset($data) and isset($data['status_message']) and $data['status_message'] != SUCCESS) {
                    $page = 1;
                    $data = $album_service->getAlbums($page);
                    $this->view('album/index', $data);
                    return;
                }

                $this->view('album/album_detail', $data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
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
                $this->view("album/insert_album", $data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function edit($album_id) {
        switch($_SERVER["REQUEST_METHOD"]){
            case "GET":
                $album_service = new AlbumService();
                $album = $album_service->detail($album_id);
                // response_json($album);
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
                $album = $album_service->detail($_POST['album_id']);
                $this->view("album/edit_album", array_merge($album, $data));
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function delete() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "DELETE":
                $album_service = new AlbumService();

                if (!isset($_GET['album_id'])) {
                    $this->view("album/index");
                    return;
                }

                $data = $album_service->delete($_GET['album_id']);
                response_json($data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function add_song() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                $album_service = new SongService();

                if (!isset($_POST['song_id']) || !isset($_POST['album_id'])) {
                    $this->view("album/index");
                    return;
                }

                $data = $album_service->add_song_to_album($_POST['song_id'], $_POST['album_id']);
                response_json($data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function delete_song() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "DELETE":
                $album_service = new SongService();

                if (!isset($_GET['song_id'])) {
                    $this->view("album/index");
                    return;
                }

                $data = $album_service->delete_song_from_album($_GET['song_id']);
                response_json($data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function unlinked_song() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $album_service = new SongService();

                if (!isset($_GET['album_id'])) {
                    $this->view("album/index");
                    return;
                }

                $data = $album_service->get_unlinked_song($_GET['album_id']);
                response_json($data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }
}