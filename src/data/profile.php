<?php
$db = include(__DIR__ . '/../database/connect_db.php');
include(__DIR__ . '/../database/queriesToDB.php');
include(__DIR__ . '/../function/userDataSaveSession.php');
include(__DIR__ . '/../function/checkEmptyFields.php');
include(__DIR__ . '/../function/recordWarning.php');
include(__DIR__ . '/../function/isEqual.php');
include(__DIR__ . '/../function/getSegmentsFromURL.php');
include(__DIR__ . '/../function/goToPage.php');

session_start();
$userID = $_SESSION['user']['id'];
$userLoginInDB = readDataToDB($db, 'users_login', ['*'], ['id' => $_SESSION['user']['id']]);
$userInfoInDB = readDataToDB($db, 'users_info', ['*'], ['user_login_id' => $_SESSION['user']['id']]);

$isDelete = getSegmentsFromURL();

if($isDelete === 'delete') {
    removeDataToDB($db, 'not_public_posts', ['author_id' => $userID]);
    removeDataToDB($db, 'public_posts', ['author_id' => $userID]);
    removeDataToDB($db, 'users_info', ['user_login_id' => $userID]);
    removeDataToDB($db, 'users_login', ['id' => $userID]);
    session_unset();
    goToPage('index');
}

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

    $isEditNick = editNick($db, $nickInfo + ['nickDB' => $userLoginInDB['nickname'], 'passDB' => $userLoginInDB['password']], $userLoginInDB['id']);
    if($isEditNick) {
        $userLoginInDB['nickname'] = $nickInfo['new-nick'];
        userLoginSaveSession($userLoginInDB);
    }
    header("Location: ../pages/profile.php");
}


if ($_POST['pass-btn']) {
    $passInfo = [
        'old-pass' => $_POST['old-pass'],
        'new-pass' => $_POST['new-pass'],
        'new-rpass' => $_POST['new-rpass'],
        'new-hash-pass' => password_hash($_POST['new-pass'], PASSWORD_DEFAULT)
    ];

    $isEditPass = editPass($db, $passInfo + ['passDB' => $userLoginInDB['password']], $userLoginInDB['id']);
    if($isEditPass) {
        $userLoginInDB['password'] = $passInfo['new-hash-pass'];
        userLoginSaveSession($userLoginInDB);
    }
    header("Location: ../pages/profile.php");

}




function addInfoUser(PDO $db, $userOldInfo, $userNewInfo, $userId) {
    (empty($userOldInfo)) ?
        addDataToDB($db,'users_info', $userNewInfo + ['user_login_id' => $userId]) :
        updateDataToDB($db, 'users_info', $userNewInfo, ['user_login_id' => $userId]);
}

function editEmail(PDO $db, array $emailInfo, int $userId): bool {
    // Проверка на пустоту полей почт
    $isEmptyFields = checkEmptyFields($emailInfo);
    if ($isEmptyFields) {
        recordWarning('profile-email', 'error', 'Заполните пустые поля');
        return false;
    }
    // Проверка соответствуют ли оба введенных емайла, если да то ошибка
    $isEqualEmails = isEqual($emailInfo['email'], $emailInfo['new-email']);
    if ($isEqualEmails) {
        recordWarning('profile-email', 'error', 'Нельзя поменять на ту же почту');
        return false;
    }
    // Проверка соответствуют ли введенная почта с почтой из бд
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

function editNick(PDO $db, array $nickInfo, int $userId): bool {
    // Проверка на пустоту полей
    $isEmptyFields = checkEmptyFields($nickInfo);
    if ($isEmptyFields) {
        recordWarning('profile-nick', 'error', 'Заполните пустые поля');
        return false;
    }
    // Проверка соответствуют ли оба введенных ника, если да то ошибка
    $isEqualNicks = isEqual($nickInfo['old-nick'], $nickInfo['new-nick']);
    if ($isEqualNicks) {
        recordWarning('profile-nick', 'error', 'Нельзя поменять на тот же никнейм');
        return false;
    }
    // Проверка соответствуют ли введенный ник с ником из бд
    $isEqualNicksInBD = isEqual($nickInfo['old-nick'], $nickInfo['nickDB']);
    if (!$isEqualNicksInBD) {
        recordWarning('profile-nick', 'error', 'Никнейм введен не верно');
        return false;
    }
    // Проверка введен ли пароль верно
    $isEqualPassInBD = password_verify($nickInfo['pass'], $nickInfo['passDB']);
    if (!$isEqualPassInBD) {
        recordWarning('profile-nick', 'error', 'Пароль введен не верно');
        return false;
    }
    // Записать в базу новый ник
    updateDataToDB($db, 'users_login', ['nickname' => $nickInfo['new-nick']], ['id' => $userId]);
    recordWarning('profile-nick', 'success', 'Никнейм успешно изменен');
    return true;
}


function editPass(PDO $db, array $passInfo, int $userId): bool {
    // Проверка на пустоту полей
    $isEmptyFields = checkEmptyFields($passInfo);
    if ($isEmptyFields) {
        recordWarning('profile-pass', 'error', 'Заполните пустые поля');
        return false;
    }
    // Проверка введен ли действующий пароль верно
    $isEqualPassInBD = password_verify($passInfo['old-pass'], $passInfo['passDB']);
    if (!$isEqualPassInBD) {
        recordWarning('profile-pass', 'error', 'Действующий пароль введен не верно');
        return false;
    }
    // Проверка соответствуют ли старый пароль и новый, если да то ошибка
    $isEqualPass = isEqual($passInfo['old-pass'], $passInfo['new-pass']);
    if ($isEqualPass) {
        recordWarning('profile-pass', 'error', 'Нельзя поменять на тот же пароль');
        return false;
    }
    // Проверка соответствуют ли новый пароль и повторно введенный пароль, если нет то ошибка
    $isEqualNewPass = isEqual($passInfo['new-pass'], $passInfo['new-rpass']);
    if (!$isEqualNewPass) {
        recordWarning('profile-pass', 'error', 'Пароли не совпадают');
        return false;
    }

    // Записать в базу новый пароль
    updateDataToDB($db, 'users_login', ['password' => $passInfo['new-hash-pass']], ['id' => $userId]);
    recordWarning('profile-pass', 'success', 'Пароль успешно изменен');
    return true;
}