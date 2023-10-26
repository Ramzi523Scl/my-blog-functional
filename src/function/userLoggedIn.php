<?php
function userLoggedIn(string $transferTo = '') {
    if(!$_SESSION['user']) {
        if ($transferTo === '') header("Location: http://my-blog2/index.php");
        else header("Location: http://my-blog2/src/pages/$transferTo.php");
    }
}