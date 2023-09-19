<?php
function getSegmentsFromURL(): string
{
    return str_replace($_SERVER['SCRIPT_NAME'] . '/', "",$_SERVER['REQUEST_URI']);
}
