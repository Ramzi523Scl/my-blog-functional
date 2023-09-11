<?php
function whereManyCharacters(array $fieldsName, array $limits): array
{
    $result = [];

    for ($i = 0; $i < count($fieldsName); $i++) {
        if (mb_strlen($_POST[$fieldsName[$i]], 'UTF-8') > $limits[$i]) {
            $result[] = $fieldsName[$i];
        }
    }
    return $result;
}