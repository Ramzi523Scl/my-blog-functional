<?php
function postSaveSession($fieldsName)
{
    for ($i = 0; $i < count($fieldsName); $i++) {
        $_SESSION[$fieldsName[$i]] = $_POST[$fieldsName[$i]];
    }
}