<?php
function redirect_home() {
    header("Location: /", true, 301);
}

function redirect_to($page, $replace = true, $status_code = 301) {
    header("Location: " . $page);
}