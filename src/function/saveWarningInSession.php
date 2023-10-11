<?php
include('recordWarning.php');
include('goToPage.php');

function saveWarningInSession(array $fields, array $warning, string $nextPage)
{
    if ($fields) {
        foreach ($fields as $field) $_SESSION[$field . '-error'] = true;
        recordWarning($warning[0], $warning[1], $warning[2]);
        goToPage($nextPage);
        exit();
    }

}