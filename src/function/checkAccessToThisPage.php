<?php
function checkAccessToThisPage(array $availableFromPages): bool
{
    foreach($availableFromPages as $page) {
        $availableFrom = ($page === 'index') ? "http://my-blog2/$page.php" : "http://my-blog2/src/pages/$page.php";
        $whereFrom = $_SERVER['HTTP_REFERER'];
        if($availableFrom === $whereFrom) return true;
    }
    return false;
}