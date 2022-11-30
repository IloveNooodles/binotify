<?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo '
        <body>
        <div class="navbar">
            <a id="home-navbar" class="hidden-mobile" href="/">Home</a>
            <a id="album-navbar" class="hidden-mobile" href="/album">Albums</a>
            <a id="user-navbar" class="hidden-mobile" href="/user">Users</a>
            <a id="insert-song-navbar" class="hidden-mobile" href="/song/new">Insert Song</a>
            <a id="insert-album-navbar" class="hidden-mobile" href="/album/new">Insert Album</a>
            <a id="insert-album-song-navbar" class="hidden-mobile" href="/album/new_song">Insert Song to Album</a>
            <div class="navbar-right">
                <form class="inline-child" action="/search">
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
        <a id="none" class="show-mobile" href="/">Home</a>
        <a id="none" class="show-mobile" href="/album">Albums</a>
        <a id="none" class="show-mobile" href="/user">Users</a>
        <a id="none" class="show-mobile" href="/song/new">Insert Song</a>
        <a id="none" class="show-mobile" href="/album/new">Insert Album</a>
        <a id="none" class="show-mobile" href="/album/new_song">Insert Song to Album</a>
        <form action="/user" method="post">
            <button type="submit" class="btn-submit">Log Out</button>
        </form>
        </div>
        <script defer src="/public/js/admin-navbar.js"></script>
        <body>';
    }
    else if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && isset($_GET['q'])){
      echo '
        <body>
        <div class="navbar">
            <a id="none" class="hidden-mobile" href="/">Home</a>
            <a id="none" class="hidden-mobile" href="/album">Albums</a>
            <a id="none" class="hidden-mobile" href="/user">Users</a>
            <a id="none" class="hidden-mobile" href="/song/new">Insert Song</a>
            <a id="none" class="hidden-mobile" href="/album/new">Insert Album</a>
            <a id="none" class="hidden-mobile" href="/album/new_song">Insert Song to Album</a>
            <div class="navbar-right">
                <button id="dropdown-btn">
                    <img class="profile-img" src="/public/img/avatar-template.jpeg" alt="user">
                    <p>' . $_SESSION['username'] . '</p>
                    <i class="arrow down"></i>
                </button>
            </div>
        </div>
        <div class="dropdown-content">
        <a id="none" class="show-mobile" href="/">Home</a>
        <a id="none" class="show-mobile" href="/album">Albums</a>
        <a id="none" class="show-mobile" href="/user">Users</a>
        <a id="none" class="show-mobile" href="/song/new">Insert Song</a>
        <a id="none" class="show-mobile" href="/album/new">Insert Album</a>
        <a id="none" class="show-mobile" href="/album/new_song">Insert Song to Album</a>
        <form action="/user" method="post">
            <button type="submit" class="btn-submit">Log Out</button>
        </form>
        </div>
        <script defer src="/public/js/admin-navbar.js"></script>
        <body>';
    }
    else if(isset($_GET['q'])){
      echo '
        <body>
        <div class="navbar">
            <a id="home-navbar" class="hidden-mobile" href="/">Home</a>
            <a id="album-navbar" class="hidden-mobile" href="/album">Albums</a>
            <a id="premium-navbar" loggedin="' . (isset($_SESSION['username']) ? 'true' : 'false') . '" class="hidden-mobile premium-navbar">
                Premium
                <label class="new">New</label>
            </a>
            <div class="navbar-right">
                <button id="dropdown-btn">
                    <img class="profile-img" src="/public/img/avatar-template.jpeg" alt="user">
                    <p>' . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest') . '</p>
                    <i class="arrow down"></i>
                </button>
            </div>
        </div>
        <div class="dropdown-content"> 
            <a id="none" class="show-mobile" href="/">Home</a>
            <a id="none" class="show-mobile" href="/album">Albums</a>
            <a id="none" loggedin="' . (isset($_SESSION['username']) ? 'true' : 'false') . '" class="show-mobile premium-navbar">
                Premium
                <label class="new">New</label>
            </a>
            <form action="/user" method="post">' .
                (isset($_SESSION['username']) ? '<button type="submit" class="btn-submit">Log Out</button>' : '<a href="/login">Log In</a><a href="/register">Register</a>') . '
            </form>
        </div>
        <script defer src="/public/js/navbar.js"></script>
        </body>';
    }
    else {
        echo '
        <body>
        <div class="navbar">
            <a id="home-navbar" class="hidden-mobile" href="/">Home</a>
            <a id="album-navbar" class="hidden-mobile" href="/album">Albums</a>
            <a id="premium-navbar" loggedin="' . (isset($_SESSION['username']) ? 'true' : 'false') . '" class="hidden-mobile premium-navbar">
                Premium
                <label class="new">New</label>
            </a>
            <div class="navbar-right">
                <form class="inline-child" action="/search">
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
            <a id="none" class="show-mobile" href="/">Home</a>
            <a id="none" class="show-mobile" href="/album">Albums</a> 
            <a id="none" loggedin="' . (isset($_SESSION['username']) ? 'true' : 'false') . '" class="show-mobile premium-navbar">
                Premium
                <label class="new">New</label>
            </a>
            <form action="/user" method="post">' .
                (isset($_SESSION['username']) ? '<button type="submit" class="btn-submit">Log Out</button>' : '<a href="/login">Log In</a><a href="/register">Register</a>') . '
            </form>
        </div>
        <script defer src="/public/js/navbar.js"></script>
        </body>';
    }
?>