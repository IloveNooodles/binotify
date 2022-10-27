<?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo '
        <body>
        <div class="navbar">
            <a id="home-navbar" href="/">Home</a>
            <a id="album-navbar" href="/album">Albums</a>
            <a id="user-navbar" href="/user">Users</a>
            <a id="insert-song-navbar" href="/song/new">Insert Song</a>
            <a id="insert-album-navbar" href="/album/new">Insert Album</a>
            <div class="navbar-right">
                <form class="inline-child" action="/song/search">
                    <input class="search-bar" type="text" placeholder="What do you want to listen to?" name="q">
                    <button type="submit" hidden>Search</button>
                </form>
                <button id="dropdown-btn">
                    <img class="profile-img" src="/public/img/avatar-template.jpeg" alt="user">
                    <p>' . $_SESSION['username'] . '</p>
                    <i class="arrow down"></i>
                </button>
            </div>
        </div>
        <div class="dropdown-content">
        <form action="/user" method="post">
            <button type="submit" class="btn-submit">Log Out</button>
        </form>
        </div>
        <script defer src="/public/js/admin-navbar.js"></script>
        <body>';
    }
    else {
        echo '
        <body>
        <div class="navbar">
            <a id="home-navbar" href="/">Home</a>
            <a id="album-navbar" href="/album">Albums</a>
            <div class="navbar-right">
                <form class="inline-child" action="/song/search">
                    <input class="search-bar" type="text" placeholder="What do you want to listen to?" name="q">
                    <button type="submit" hidden>Search</button>
                </form>
                <button id="dropdown-btn">
                    <img class="profile-img" src="/public/img/avatar-template.jpeg" alt="user">
                    <p>' . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest') . '</p>
                    <i class="arrow down"></i>
                </button>
            </div>
        </div>
        <div class="dropdown-content"> 
        <form action="/user" method="post">' .
        (isset($_SESSION['username']) ? '<button type="submit" class="btn-submit">Log Out</button>' : '<a href="/login">Log In</a><a href="/register">Register</a>') . '
        </form>
        </div>
        <script defer src="/public/js/navbar.js"></script>
        </body>';
    }
?>