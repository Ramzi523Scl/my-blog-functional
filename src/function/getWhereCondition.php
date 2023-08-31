<?php
include('getShieldedData.php');
function getWhereCondition( array $elements): string
{
    return implode(' AND ', getShieldedData($elements));
}
