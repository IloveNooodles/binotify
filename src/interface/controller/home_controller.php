<?php
require_once BASE_URL . '/src/service/search/index.php';
require_once BASE_URL . '/src/utils/http_response.php';

class Home extends Controller {
    public function index() {
        $search_service = new SearchService();

        if (isset($_GET['page']) and $_GET['page'] > 0) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $data = $search_service->search_all_song($page);
        
        $this->view('home/index', $data);
    }
}
?>