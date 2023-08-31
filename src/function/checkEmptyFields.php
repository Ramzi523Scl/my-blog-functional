<?php

function checkEmptyFields(array $fields): bool
{
    return in_array('', $fields, true);
}


