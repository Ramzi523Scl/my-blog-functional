<?php
function deleteFromSession(string $itemName)
{
    unset($_SESSION[$itemName]);
}