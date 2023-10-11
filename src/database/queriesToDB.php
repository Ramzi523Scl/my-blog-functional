<?php
include('../function/getWhereCondition.php');

// Функция добавления данных в бд
function addDataToDB(PDO $connection, string $tableName, array $data) {
//    var_dump($data);
//    exit();
    $columns = implode(", ", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));

    $query = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";

    $statement = $connection->prepare($query);

    foreach ($data as $key => $value) {
        $statement->bindValue(":$key", $value);
    }
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);

}

// Функция чтения данных из бд
function readDataToDB(PDO $connection, string $tableName, $readData = '*', array $whereData = [], bool $readAll = false): array
{
    if(is_array($readData)) $readData = implode(', ', $readData);
    $query = "SELECT $readData FROM $tableName";

    if($whereData) {
        $whereCondition = getWhereCondition($whereData);
        $query .= " WHERE $whereCondition";
    }
    $statement = $connection->prepare($query);
    foreach ($whereData as $key => $value) {
        $statement->bindValue(":$key", $value);
    }
    $statement->execute();

    if ($readAll) $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    else $result = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$result) $result = [];
    return $result;
}



// Функция удаления данных из бд
function removeDataToDB(PDO $connection, string $tableName, array $whereData) {

    $whereConditions = getWhereCondition(($whereData));
    $query = "DELETE FROM $tableName WHERE $whereConditions";
    $statement = $connection->prepare($query);

    foreach ($whereData as $key => $value) {
        $statement->bindValue(":$key", $value);
    }
    $statement->execute();
}


// Функция обновления данных в бд

function updateDataToDB(PDO $connection, string $tableName, array $updateData, array $whereData) {


    $preparedUpdateData = implode(', ', getShieldedData($updateData));
    $preparedWhereData = getWhereCondition($whereData);
    $query = "UPDATE $tableName SET $preparedUpdateData WHERE $preparedWhereData";
    $statement = $connection->prepare($query);

    foreach (($updateData + $whereData) as $key => $value) {
        $statement->bindValue(":$key", $value);
    }
    $statement->execute();
}
