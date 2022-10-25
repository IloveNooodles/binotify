<?php
function response_json($data, $status_code = 200) {
    $json = json_encode($data);
    http_response_code($status_code);
    echo $json;
}
?>