<?php
$db = include('../database/connect_db.php');
include('../database/queriesToDB.php');
include('../function/userDataSaveSession.php');
include('../function/checkEmptyFields.php');
include('../function/recordWarning.php');
include('../function/isEqual.php');


session_start();
$userLoginInDB = readDataToDB($db, 'users_login', ['*'], ['id' => $_SESSION['user']['id']]);
$userInfoInDB = readDataToDB($db, 'users_info', ['*'], ['user_login_id' => $_SESSION['user']['id']]);

if ($_POST['info-btn']) {
    $userInfo = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'birthday' => $_POST['date-birth'],
        'tel' => $_POST['tel'],
        'address' => $_POST['address'],
        'gender' => $_POST['gender']
    ];
    addInfoUser($db, $userInfoInDB, $userInfo, $userLoginInDB['id']);
    userInfoSaveSession($userInfo);
    header("Location: ../pages/profile.php");
}


if ($_POST['email-btn']) {
    $emailInfo = [
        'email' => $_POST['email'],
        'new-email' => $_POST['new-email']
    ];
    $isEditEmail = editEmail($db, $emailInfo + ['emailDB' => $userLoginInDB['email']], $userLoginInDB['id']);
    if($isEditEmail) {
        $userLoginInDB['email'] = $emailInfo['new-email'];
        userLoginSaveSession($userLoginInDB);
    }
    header("Location: ../pages/profile.php");
}


if ($_POST['nick-btn']) {
    $nickInfo = [
        'old-nick' => $_POST['old-nick'],
        'new-nick' => $_POST['new-nick'],
        'pass' => $_POST['pass']
    ];
}


if ($_POST['pass-btn']) {
    $passInfo = [
        'pass' => $_POST['pass'],
        'new-pass' => $_POST['new-pass'],
        'new-rpass' => $_POST['new-rpass']
    ];
}




function addInfoUser(PDO $db, $userOldInfo, $userNewInfo, $userId) {
    (empty($userOldInfo)) ?
        addDataToDB($db,'users_info', $userNewInfo + ['user_login_id' => $userId]) :
        updateDataToDB($db, 'users_info', $userNewInfo, ['user_login_id' => $userId]);
}

function editEmail(PDO $db, array $emailInfo, $userId): bool {
    // Проверка на пустату полей почт
    $isEmptyFields = checkEmptyFields($emailInfo);
    if ($isEmptyFields) {
        recordWarning('profile-email', 'error', 'Заполните пустые поля');
        return false;
    }
    // Проверка соответсвуют ли оба введенныйх емайла, если да то ошибка
    $isEqualEmails = isEqual($emailInfo['email'], $emailInfo['new-email']);
    if ($isEqualEmails) {
        recordWarning('profile-email', 'error', 'Нельзя поменять на ту же почту');
        return false;
    }
    // Проверка соответсвует ли введенная почта с почтой из бд
    $isEqualEmailsInBD = isEqual($emailInfo['email'], $emailInfo['emailDB']);
    if (!$isEqualEmailsInBD) {
        recordWarning('profile-email', 'error', 'Почта введена не верно');
        return false;
    }
    // Записать в базу новую почту
    updateDataToDB($db, 'users_login', ['email' => $emailInfo['new-email']], ['id' => $userId]);
    recordWarning('profile-email', 'success', 'Почта успешно изменена');
    return true;
}

