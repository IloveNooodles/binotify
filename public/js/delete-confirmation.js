document.getElementById('album-delete-btn').addEventListener('click', function(e) {
    document.querySelector('div.album-delete-confirmation').classList.add('show');
    document.querySelector('div.album-delete-confirmation div.confirmation-box').classList.add('show');});

document.getElementById('album-cancel-btn').addEventListener('click', function(e) {
    document.querySelector('div.album-delete-confirmation').classList.remove('show');
    document.querySelector('div.album-delete-confirmation div.confirmation-box').classList.remove('show');});


document.querySelectorAll('.remove-song-from-album-button').forEach(function(element) {
    element.addEventListener('click', function(e) {
        e.stopPropagation();
        document.querySelector('div.song-delete-confirmation').classList.add('show');
        document.querySelector('div.song-delete-confirmation div.confirmation-box').classList.add('show');
        document.getElementById('delete-link').href = element.getAttribute('name');
    });
});

document.getElementById('song-cancel-btn').addEventListener('click', function(e) {
    document.querySelector('div.song-delete-confirmation').classList.remove('show');
    document.querySelector('div.song-delete-confirmation div.confirmation-box').classList.remove('show');});