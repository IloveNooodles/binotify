<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload">
    <input type="submit" name="submit" value="Please upload image">
  </form>
</body>
</html>

<?php 
// print_r(php_ini_loaded_file());
// print_r(phpinfo());
define("TARGET_DIR", $_ENV['PWD'] . "/public/audio/");

if(isset($_FILES)){
  print_r($_FILES);
  print_r(phpinfo());
  // echo TARGET_DIR;
  $curdir = $_FILES["fileToUpload"]['tmp_name'];
  $target_dir = TARGET_DIR . "1.mp3";
  echo $curdir;
  echo $target_dir;
  $res = move_uploaded_file($curdir, $target_dir);
  if($res){
    echo "success";
  } else {
    echo "failed";
  };
}

?>