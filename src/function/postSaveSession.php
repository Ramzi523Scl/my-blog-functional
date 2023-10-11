<?php
function postSaveSession($fieldsName, $from)
{
    for ($i = 0; $i < count($fieldsName); $i++) {
        $_SESSION[$fieldsName[$i]] = $from[$fieldsName[$i]];
    }
}