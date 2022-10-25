<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Binotify - Albums</title>
  <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
  <?php include_once 'src/view/component/navbar.php' ?>
  <h1>Albums</h1>
  <form action="/album" method="post">
    <input class="body-search" type="text" name="search" placeholder="Search">
    <input type="submit" hidden value="Search">
  </form>
  <?php include_once 'src/view/component/albumList.php' ?>
</body>
</html>
