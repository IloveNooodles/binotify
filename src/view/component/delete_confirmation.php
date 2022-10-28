<?php
function delete_confirmation_album($id) {
    $html = <<<"EOT"
    <div class="album-delete-confirmation">
        <div class="confirmation-box">
            <p class="confirmation-text">Are you sure you want to delete this?</p>
            <div class="footer">
                <button class="btn" id="album-cancel-btn">Cancel</button>
                <a href="/album/delete?album_id=$id">
                    <button class="btn btn-danger" id="delete-btn">Delete</button>
                </a>
            </div>
        </div>
    </div>
EOT;
    echo $html;
}

function delete_confirmation_song($id) {
    $html = <<<"EOT"
    <div class="song-delete-confirmation">
        <div class="confirmation-box">
            <p class="confirmation-text">Are you sure you want to delete this?</p>
            <div class="footer">
                <button class="btn" id="song-cancel-btn">Cancel</button>
                <a id="delete-link" href="/song/delete?song_id=$id">
                    <button class="btn btn-danger" id="delete-btn">Delete</button>
                </a>
            </div>
        </div>
    </div>
EOT;
    echo $html;
}