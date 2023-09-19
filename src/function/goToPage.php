<?php
include('createURL.php');
function goToPage(string $page): void
{
    $url = createURL($page);
    header("Location:$url");
}