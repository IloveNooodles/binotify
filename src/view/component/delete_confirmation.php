<?php
function delete_confirmation($thing, $id) {
    $thing_id = $thing . '_id';
    $html = <<<"EOT"
    <div class="background">
        <div class="confirmation-box">
            <p class="confirmation-text">Are you sure you want to delete this?</p>
            <div class="footer">
                <button class="btn" id="cancel-btn">Cancel</button>
                <a href="/$thing/delete?$thing_id=$id">
                    <button class="btn btn-danger" id="delete-btn">Delete</button>
                </a>
            </div>
        </div>
    </div>
EOT;
    echo $html;
}