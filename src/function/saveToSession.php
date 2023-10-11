<?php

function saveToSession( string $itemName, array $data): void
{
     $_SESSION[$itemName] = $data;
}