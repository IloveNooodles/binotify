<?php
require_once BASE_URL . '/src/service/song/index.php';
require_once BASE_URL . '/src/service/search/index.php';

class Song extends Controller {
    public function index($query=null){
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                redirect_to("search/index");
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function detail($id = -1) {
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                $song_service = new SongService();
                
                if ($id == -1) {
                    redirect_home();
                    return;
                }
                
                $data = $song_service->detail($id);
                if (isset($data) and isset($data['status_message']) and $data['status_message'] != SUCCESS) {
                    redirect_home();
                    return;
                }

                $this->view('song/song_detail', $data);
                break;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function new() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $this->view("song/insert_song");
                return;
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
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function edit($id = 1) {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $song_service = new SongService();
                $song = $song_service->detail($id);
                $this->view("song/edit_song", $song);
                return;
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
                $song = $song_service->detail($id);
                $this->view("song/edit_song", array_merge($song, $data));

                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function delete() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "DELETE":
                $song_service = new SongService();

                if (!isset($_GET['song_id'])) {
                    $this->view("search/index");
                    return;
                }

                $data = $song_service->delete($_GET['song_id']);
                response_json($data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
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

                response_json($data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function all_distinct_genre() {
        switch($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $song_service = new SongService();
                $data = $song_service->all_distinct_genre();
                response_json($data);
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }

    public function play_song(){
        $middleware = new Middleware();
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                return;
            default:
                response_not_allowed_method();
                return;
        }
    }
}