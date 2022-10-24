class Navbar extends HTMLElement {
    constructor() {
        super();
        if (window.sessionStorage.getItem('role') === 'admin') {
            this.innerHTML = `
            <div class="navbar">
                <a class="active" href="/">Home</a>
                <a>Insert Songs</a>
                <a>Insert Albums</a>
                <a>Albums</a>
                <div class="navbar-right">
                    <form class="inline-child" action="/action_page.php">
                        <input type="text" placeholder="What do you want to listen to?" name="search">
                        <button type="submit" hidden>Search</button>
                    </form>
                    <button id="dropdown-btn">
                        <img class="profile-img" src="/public/img/avatar-template.jpeg" alt="user">
                        <p>` + window.sessionStorage.getItem('user') + `</p>
                        <i class="arrow down"></i>
                    </button>
                </div>
            </div>
            <div class="dropdown-content">` +
            (window.sessionStorage.getItem('user') ? `<a href="#">Log Out</a>` : `<a href="#">Log In</a>`) + `
            </div>`;
        }
        else {
            this.innerHTML = `
            <div class="navbar">
                <a class="active" href="/">Home</a>
                <a>Albums</a>
                <div class="navbar-right">
                    <form class="inline-child" action="/action_page.php">
                        <input type="text" placeholder="What do you want to listen to?" name="search">
                        <button type="submit" hidden>Search</button>
                    </form>
                    <button id="dropdown-btn">
                        <img class="profile-img" src="/public/img/avatar-template.jpeg" alt="user">
                        <p>` + (window.sessionStorage.getItem('user') ? window.sessionStorage.getItem('user') : `Guest`) + `</p>
                        <i class="arrow down"></i>
                    </button>
                </div>
            </div>
            <div class="dropdown-content">` +
            (window.sessionStorage.getItem('user') ? `<a href="#">Log Out</a>` : `<a href="#">Log In</a>`) + `
            </div>`;
        }
    }
}

window.customElements.define('top-navbar',Navbar);