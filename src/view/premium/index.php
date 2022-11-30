<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binotify - Premium Artist</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/premiumArtistList.css">
    <link rel="stylesheet" href="/public/css/notification.css">
</head>
<body>
    <?php
        require_once 'src/view/component/notification.php';
        subscribe_notification("Subscription request has been sent.");
    ?>
    <?php include_once 'src/view/component/navbar.php' ?>
    <h2 class="pageTitle">Premium Artist</h2>
    <?php include_once 'src/view/component/premium_artist_list.php' ?>
    <script src="/public/js/premium.js"></script>
    <script src="/public/js/notification.js"></script>
</body>