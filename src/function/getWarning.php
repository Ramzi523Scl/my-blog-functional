<?php

function getWarning($nameBlock)
{
    if(!$_SESSION[$nameBlock]) return '';

    $warnStatus = $_SESSION[$nameBlock]['status'];
    $msg = $_SESSION[$nameBlock]['msg'];

    if ($warnStatus === 'error') echo '<div class="alert alert-danger">';
    elseif ($warnStatus === 'success') echo '<div class="alert alert-success">';

    print_r($msg);
    echo '</div>';
    unset($_SESSION[$nameBlock]);
}

