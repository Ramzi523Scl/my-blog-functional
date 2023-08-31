<?php

function connect_db(): PDO
{
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    $db = new PDO('mysql:host=localhost;dbname=my_blog2', 'root', '', $options);
    return $db;
}
return connect_db();