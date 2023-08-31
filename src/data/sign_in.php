<?php
$db = include("../database/connect_db.php");
include("../function/checkEmptyFields.php");
include("../function/recordWarning.php");
include("../database/queriesToDB.php");
include("../function/userDataSaveSession.php");
include("../function/tt.php");

session_start();

$login_details = [
    'nickname' => $_POST['nickname'],
    'password' => $_POST['password']
];

// запрос на бд по введенным данным(неудача или успех)
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    echo "Success";
//} else echo "Провал";

$is_empty = checkEmptyFields($login_details);                                                                     // проверка на заполненность полей
if ($is_empty) {
    recordWarning('sign', 'error', 'Заполните пустые поля');                                // запись предупреждения в сессию, если поля пустые
    header("Location: ../pages/sign_in.php");
    exit();
}

$userLogin = readDataToDB($db, 'users_login', ['*'],  ['nickname' => $_POST['nickname']]);               // запрос на полученние данных в бд по введенному нику
authenticateUser($userLogin, $login_details);                                                                     // Функция проверяет, ввел ли пользователь правильно логин и пароль

$userInfo = readDataToDB($db, 'users_info', ['*'], ['user_login_id' => $userLogin['id']] );              // Беру из бд дополнительную инфу о пользователе, если она есть(фио, дата рождения итп)
userInfoSaveSession($userInfo);                                                                                   // сохраняю в сессию допольнительную инфу о пользователе, если она есть

header('Location: /src/pages/profile.php');
exit();


// функцмя проверяет на соответствие данные входа(логин и пароль) введенных пользователем с данными из бд
function authenticateUser($user, $authData) {
    $is_auth = (!empty($user)) && password_verify($authData['password'], $user['password']);
//    $is_auth = (!empty($user)) && ($authData['password'] === $user['password']);
    if (!$is_auth) {
        recordWarning('sign', 'error', 'Логин или пароль не верный');
        header("Location: ../pages/sign_in.php");
        exit();
    }
    userLoginSaveSession($user);                                                                                    // если данные введены правильно, то сохраняю их в сессию
}
