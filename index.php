<?php	
if (!session_id()) {
  session_start();
};
require_once $_ENV['PWD'] . '/src/init.php';	
$app = new App();
?>