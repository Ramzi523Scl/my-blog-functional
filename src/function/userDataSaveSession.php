<?php
// функция сохранения данных входа(логин, пароль, емайл, id) в сессию
function userLoginSaveSession(array $user): bool {
    if (!empty($user)) {
        $_SESSION['user']['isAuth'] = true;
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['nick'] = $user['nickname'];

        return true;
    }
    return false;
}

// функция сохранения данных о пользователе(фио, дата рождения, адресс) в сессию
function userInfoSaveSession(array $user): bool {
    if (!empty($user)) {
        $_SESSION['user']['info']['firstname'] = $user['firstname'];
        $_SESSION['user']['info']['lastname'] = $user['lastname'];
        $_SESSION['user']['info']['birthday'] = $user['birthday'];
        $_SESSION['user']['info']['tel'] = $user['tel'];
        $_SESSION['user']['info']['address'] = $user['address'];
        $_SESSION['user']['info']['gender'] = $user['gender'];
        return true;
    }
    $_SESSION['user']['info'] = false;
    return false;
}