<?php
$db = include('../database/connect_db.php');
include('../database/queriesToDB.php');
include('../function/checkEmptyFields.php');
include('../function/recordWarning.php');
include('../function/postSaveSession.php');
include('../function/whichFieldsEmpty.php');
include('../function/whereManyCharacters.php');
include('../function/createHash.php');

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
    if ($_POST['clear-btn']) clearField($fieldsName + ['post-img'], '../pages/create_post.php');

    // Сохраняет данные поста в сессию, чтобы отобразить их при обновлении страницы
    postSaveSession($fieldsName);

    // Если поля пустые, то выводит предупреждение о том что нужно заполнить поля
    $is_empty_fields = whichFieldsEmpty($fieldsName);
    saveWarningInSession($is_empty_fields, ['create-post', 'error', 'Заполните пустые места'],  '../pages/create_post.php');

    // Если пользователь ввел больше символов в полях, чем нужно выводит предупреждение
    $fields_with_error = whereManyCharacters($fieldsName, [55, 200, 2500]);
    saveWarningInSession($fields_with_error, ['create-post', 'error', 'Слишком много символов'],  '../pages/create_post.php');

    // Создает ассоциативный массив данных, которые нужно добавить в БД
    $postData = createHash($columnNamesInBD, $value);

    // Записывает в БД данные в зависимости от того на какую кнопку нажал пользователь
    if ($_POST['save-btn']) addDataToDB($db, 'not_public_posts', $postData);
    if ($_POST['post-btn']) addDataToDB($db, 'public_posts', $postData);
    // Предупреждает пользователя о том что пост сохранен
    // И очищает все поля
    recordWarning('create-post', 'success', 'Пост успешно сохранен');
    clearField($fieldsName + ['post-img'], '../pages/create_post.php');
    exit();

}


# TODO Вынести эти функции в общие функции, если они пригодятся
function clearField(array $fieldsName, string $location)
{
    foreach ($fieldsName as $field) {
        unset($_SESSION[$field]);
    }
    header("Location: $location");
    exit();
}

function saveWarningInSession(array $fields, array $warning, string $location)
{
    if ($fields) {
        foreach ($fields as $field) $_SESSION[$field . '-error'] = true;
        recordWarning($warning[0], $warning[1], $warning[2]);
        header("Location: $location");
        exit();
    }

}



