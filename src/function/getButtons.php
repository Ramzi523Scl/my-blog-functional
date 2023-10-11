<?php
function getButtons(array $buttons, array $buttonsCondition = [], bool $condition = null): array
{
    $allButtons = [$buttons, $buttonsCondition];
    return $condition ? $allButtons : [$buttons];
}

