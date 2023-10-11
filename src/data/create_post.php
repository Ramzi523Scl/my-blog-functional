<?php
$db = include('../database/connect_db.php');
include('../database/queriesToDB.php');
include('../function/checkEmptyFields.php');
include('../function/postSaveSession.php');
include('../function/whichFieldsEmpty.php');
include('../function/whereManyCharacters.php');
include('../function/createHash.php');
include('../function/clearField.php');
include('../function/saveWarningInSession.php');

session_start();

// Запускает функцию, которая создаст и добавит пост
createPost($db);


function createPost($db) {

    // Название колонок из таблицы бд
    $columnNamesInBD = [
        "name",
        "description",
        "post_text",
        "post_date",
        "image",
        "author_id"
    ];

    // Необходимые значения для записи в бд
    $value = [
        $_POST['post-title'],
        $_POST['post-descr'],
        $_POST['post-text'],
        date(" Y-m-d"),
        $_POST['post-img'],
        $_SESSION['user']['id']
    ];

    // Поля куда пользователь вводит название, описание, текст поста
    $fieldsName = [
        'post-title',
        'post-descr',
        'post-text',
    ];

    // Очищает поля при нажатии на кнопку очистить
    if ($_POST['clear-btn']) {
        clearField($fieldsName + ['post-img']);
        goToPage('create_post');
        exit();
    }

    // Сохраняет данные поста в сессию, чтобы отобразить их при обновлении страницы
    postSaveSession($fieldsName, $_POST);

    // Если поля пустые, то выводит предупреждение о том что нужно заполнить поля
    $is_empty_fields = whichFieldsEmpty($fieldsName);
    saveWarningInSession($is_empty_fields, ['create-post', 'error', 'Заполните пустые места'],  'create_post');

    // Если пользователь ввел больше символов в полях, чем нужно выводит предупреждение
    $fields_with_error = whereManyCharacters($fieldsName, [55, 200, 2500]);
    saveWarningInSession($fields_with_error, ['create-post', 'error', 'Слишком много символов'],  'create_post');

    // Создает ассоциативный массив данных, которые нужно добавить в БД
    $postData = createHash($columnNamesInBD, $value);

    // Записывает в БД данные в зависимости от того на какую кнопку нажал пользователь
    if ($_POST['save-btn']) addDataToDB($db, 'not_public_posts', $postData);
    if ($_POST['post-btn']) addDataToDB($db, 'public_posts', $postData);
    // Предупреждает пользователя о том что пост сохранен
    // И очищает все поля
    recordWarning('create-post', 'success', 'Пост успешно сохранен');
    clearField($fieldsName + ['post-img']);
    goToPage('create_post');
    exit();

}