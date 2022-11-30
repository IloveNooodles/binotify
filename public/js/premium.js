document.querySelectorAll('.subscribe').forEach(component => {
    component.addEventListener('click', () => {
        document.querySelector(".notification").classList.toggle('show');
        document.querySelector(".notification-box").classList.toggle('show');
    })
});