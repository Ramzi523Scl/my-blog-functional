<?php
function recordWarning($placeWarning, $status, $text){
    $_SESSION[$placeWarning]['status'] = $status;
    $_SESSION[$placeWarning]['msg'] = $text;
}