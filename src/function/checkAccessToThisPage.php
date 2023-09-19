<?php
function checkAccessToThisPage(string $availableFromPage): bool
{
    return $_SERVER['HTTP_REFERER'] === "http://my-blog2/src/pages/$availableFromPage.php";
}