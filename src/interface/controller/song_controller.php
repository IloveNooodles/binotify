<?php
require_once BASE_URL . '/src/service/song/index.php';
require_once BASE_URL . '/src/service/search/index.php';

class Song extends Controller {
    public function index($query=null){
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                $this->view("search/index");
                break;
            default:
                response_json(["status_message" => METHOD_NOT_ALLOWED], 405);
                break;
        }
    }

    public function detail() {
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                $song_service = new SongService();
                $id = $_GET['id'];
                $song = $song_service->detail($id);
                response_json($song);
                break;
            default:
                response_json(["status_message" => METHOD_NOT_ALLOWED], 405);
                break;
        }
    }

    public function new() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $this->view("song/insert_song");
                break;
            case "POST":
                $song_service = new SongService();
                $data = NULL;

                if (empty($_POST['judul']) || empty($_POST['penyanyi']) || empty($_POST['tanggal']) || empty($_POST['genre']) || empty($_FILES['cover']) || empty($_FILES['song'])) {
                    $data = ["status_message" => DATA_NOT_COMPLETE];
                }
                else {
                    $status = $song_service->new($_POST['judul'], $_POST['penyanyi'], $_POST['tanggal'], $_POST['genre'], $_FILES['cover'], $_FILES['song']);
                    $data = ["status_message" => $status];
                }
                $this->view("song/insert_song", $data);
                return;
                break;
            default:
                response_json(["status_message" => METHOD_NOT_ALLOWED], 405);
                break;
        }
    }

    public function edit() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $song_service = new SongService();
                $song = $song_service->detail($_GET['id']);
                $this->view("song/edit_song", $song);
                break;
            case "POST":
                $song_service = new SongService();
                if (empty($_POST['song_id'] || $_POST['judul']) || empty($_POST['penyanyi']) || empty($_POST['tanggal']) || empty($_POST['genre'])) {
                    $data = ["status_message" => DATA_NOT_COMPLETE];
                }
                else {
                    $cover = isset($_FILES['cover']) ? $_FILES['cover'] : null;
                    $song = isset($_FILES['song']) ? $_FILES['song'] : null;

                    $status = $song_service->edit($_POST['song_id'], $_POST['judul'], $_POST['penyanyi'], $_POST['tanggal'], $_POST['genre'], $cover, $song);
                    $data = ["status_message" => $status];
                }
                // $this->view("song/edit_song", $data);
                response_json($data);
                return;
                break;
            default:
                response_json(["status_message" => METHOD_NOT_ALLOWED], 405);
                break;
        }
    }

    public function delete() {
        $song_service = new SongService();
        $song_service->delete($_POST['id']);
        // belom tau redirect kemana
    }

    public function search() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $search_service = new SearchService();

                $word = isset($_GET['q']) ? $_GET['q'] : "";
                $genre = isset($_GET['genre']) ? $_GET['genre'] : "all";
                $asc = isset($_GET['asc']) ? $_GET['asc'] : true;
                $page = (isset($_GET['page']) and (int)$_GET['page'] >= 1)? $_GET['page'] : 1;
                $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : "judul";

                $data = $search_service->search_song($word, $genre, $asc, $orderby, $page);
                $this->view("search/index", $data);
                return;
                break;
            default:
                response_json(["status_message" => METHOD_NOT_ALLOWED], 405);
                return;
                break;
        }
    }

    public function play_song(){
        $middleware = new Middleware();
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                break;
            default:
                response_json(["status_message" => METHOD_NOT_ALLOWED], 405);
                break;
        }
    }
}