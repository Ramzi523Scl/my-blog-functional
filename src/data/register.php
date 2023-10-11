<?php
$db = include('../database/connect_db.php');
include('../function/checkEmptyFields.php');
include('../function/recordWarning.php');
include('../database/queriesToDB.php');
include('../function/userDataSaveSession.php');

session_start();

$registerData = [
    'email' => $_POST['email'],
    'nickname' => $_POST['nickname'],
    'password' => $_POST['pass'],
    'repeatPassword' => $_POST['repeatPass']
];

$is_empty = checkEmptyFields($registerData); // проверка заполнены ли все поля
if ($is_empty) {
    recordWarning('register', 'error', 'Заполните пустые поля'); // записывает в сессию необходимое предупреждение
    header("Location: ../pages/register.php");
    exit();
}
$is_user_validation = userValidation($db, $registerData); // проверка на корректность внесенных данных пользователем
if (!$is_user_validation) exit();

$userData = [
    'email' => $_POST['email'],
    'nickname' => $_POST['nickname'],
    'password' => password_hash($_POST['pass'], PASSWORD_DEFAULT),
];
addDataToDB($db, 'users_login', $userData);                                                      // добавляет пользователя в бд
$newUserData = readDataToDB($db, 'users_login', ['*'], ['nickname' => $userData['nickname']]);   // Получаю новую инфу о пользователе с бд
userLoginSaveSession($newUserData);                                                                       // добавляет данные пользователя в сессию
header("Location: ../pages/profile.php");
exit();                                                                           // КОНЕЦ КОДА!!!


function userValidation($db, array $userData): bool {
    $result = false;
    $pass = $userData['password'];
    $repeatPass = $userData['repeatPassword'];
    $nick = ['nickname' => $userData['nickname']];


    if (strlen($pass) < 2) recordWarning('register', 'error', 'Пароль должен состоять минимум из 8 символов');
    elseif ($pass != $repeatPass) recordWarning('register', 'error', 'Пароли не совпадают');
    elseif (checkNickInDB($db, $nick)) recordWarning('register', 'error', 'Этот ник уже занят');
    else $result = true;

    if(!$result) header('Location: /src/pages/register.php');
    return $result;
}
function checkNickInDB($db, $nickname): bool {
    $user = readDataToDB($db, 'users_login', ['*'], $nickname);
    return (bool)$user;
}