<?php
function whichFieldsEmpty(array $fieldsName): array
{
    $result = [];
    for ($i = 0; $i < count($fieldsName); $i++) {
        if ($_POST[$fieldsName[$i]] === '') $result[] = $fieldsName[$i];
    }
    return $result;
}