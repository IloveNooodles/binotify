<?php

class Cmd {
    public function __construct() {

    }

    public function exec_command($command) {
        $output = shell_exec($command);
        return $output;
    }
}