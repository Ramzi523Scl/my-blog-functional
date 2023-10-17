<?php
include('createURL.php');
function goToPage(string $page): void
{

    $dir = 'src/pages';
    $url = createURL($dir, $page);
    if ($page === 'index') $url = "http://my-blog2/$page.php";
    header("Location:$url");
}