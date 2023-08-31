<?php
function userLoggedIn() {
    if(!$_SESSION['user']) header('Location: ../../index.php');
}