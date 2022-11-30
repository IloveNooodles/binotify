document.getElementById("dropdown-btn").addEventListener("click", function () {
    document.querySelector(".dropdown-content").classList.toggle("show");
    document.querySelector(".arrow").classList.toggle("down");
    document.querySelector(".arrow").classList.toggle("up");
});

document.querySelectorAll(".premium-navbar").forEach(element => {
    element.addEventListener("click", function () {
    if (document.getElementById("premium-navbar").getAttribute("loggedin") == "true") {
        window.location.href = "/premium";
    } else {
        document.querySelector(".notification").classList.toggle('show');
        document.querySelector(".notification-box").classList.toggle('show');
    }
})});

if (window.location.pathname === "/") {
    document.getElementById("home-navbar").classList.add("active");
}
else if (window.location.pathname === "/album") {
    document.getElementById("album-navbar").classList.add("active");
}
else if (window.location.pathname === "/premium" || window.location.pathname.includes("/subscribed")) {
    document.getElementById("premium-navbar").classList.add("active");
}