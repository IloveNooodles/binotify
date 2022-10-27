document.querySelectorAll(".content").forEach((content) => {
    content.addEventListener("click", () => {
        window.location.href = '/song/detail/' + content.getAttribute("name");
    })
})