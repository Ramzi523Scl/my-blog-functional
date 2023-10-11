<?php
function clearField(array $fieldsName): void
{
    foreach ($fieldsName as $field) {
        unset($_SESSION[$field]);
    }
}