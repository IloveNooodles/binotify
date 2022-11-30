<?php
function subscribe_notification($message) {
    $html = <<<"EOT"
    <div class="notification">
        <div class="notification-box">
            <p class="notification-text">$message</p>
            <div class="footer">
                <button class="btn" id="notification-close-button">Ok</button>
            </div>
        </div>
    </div>
EOT;
    echo $html;
}
