<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Binotify</title>
  <link rel="stylesheet" href="/public/css/styles.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/songList.css">
  <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
</head>
<body>
  <?php include_once 'src/view/component/navbar.php' ?>
  <h1 class="title">Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest' ?> </h1>
  <?php include_once 'src/view/component/songList.php' ?>
</body>
</html>