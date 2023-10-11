<?php
include('createURL.php');
function goToPage(string $page): void
{
    $dir = 'src/pages';
    $url = createURL($dir, $page);
    header("Location:$url");
}