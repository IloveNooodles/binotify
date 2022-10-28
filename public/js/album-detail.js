document.getElementById('album-delete-btn').addEventListener('click', function(e) {
    document.querySelector('div.background').classList.add('show');
    document.querySelector('div.background div.confirmation-box').classList.add('show');});

document.getElementById('cancel-btn').addEventListener('click', function(e) {
    document.querySelector('div.background').classList.remove('show');
    document.querySelector('div.background div.confirmation-box').classList.remove('show');});
