document.getElementById("notification-close-button").addEventListener('click', () => {
    document.querySelector(".notification").classList.toggle('show');
    document.querySelector(".notification-box").classList.toggle('show');
});