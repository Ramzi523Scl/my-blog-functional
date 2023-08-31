<?php
function getShieldedData(array $data): array
{
    $result = array_map("concatenation", array_keys($data));
    return $result;
}
function concatenation(string $elem): string {
    return $elem . '=:' . $elem;
}
