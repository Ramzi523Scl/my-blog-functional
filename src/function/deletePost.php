<?php
include("goToPage.php");
function deletePost(PDO $db, string $table, int $id, string $nextPage = null): void
{
    removeDataToDB($db, $table, ['id' => $id]);
    if ($nextPage) goToPage($nextPage);
}
