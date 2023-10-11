<?php
$db = include('../database/connect_db.php');
include('../database/queriesToDB.php');
include('../function/getSegmentsFromURL.php');
include('../function/definePostTable.php');
include('../function/clearField.php');
include('../function/createHash.php');
include('../function/postSaveSession.php');
include('../function/whichFieldsEmpty.php');
include('../function/whereManyCharacters.php');
include('../function/saveWarningInSession.php');

session_start();

if ($_POST['clear']) {
    clearField(['name', 'description', 'post_text', 'image']);
    goToPage('edit_post');
    exit();
}

$fieldsName = [
    'name',
    'description',
    'post_text',
];

postSaveSession(['name', 'description', 'post_text', 'image'], $_POST);

// Если поля пустые, то выводит предупреждение о том что нужно заполнить поля
$is_empty_fields = whichFieldsEmpty($fieldsName);
saveWarningInSession($is_empty_fields, ['edit-post', 'error', 'Заполните пустые места'],  'edit_post');

// Если пользователь ввел больше символов в полях, чем нужно выводит предупреждение
$fields_with_error = whereManyCharacters($fieldsName, [55, 200, 2500]);
saveWarningInSession($fields_with_error, ['edit-post', 'error', 'Слишком много символов'],  'edit_post');

$userID = (int) $_SESSION['user']['id'];
$postID = (int) $_SESSION['post']['id'];

// Название колонок из таблицы бд
$columnNamesInBD = [
    "name",
    "description",
    "post_text",
    "post_date",
    "image",
    'author_id'
];

// Необходимые значения для записи в бд
$value = [
    $_POST['name'],
    $_POST['description'],
    $_POST['post_text'],
    date(" Y-m-d"),
    $_POST['image'],
    $userID,
];

$updatedPostData = createHash($columnNamesInBD, $value);

if ($_POST['save']) saveEditedPost($db, $updatedPostData, $postID);
if ($_POST['publish']) publishPost($db, $updatedPostData, $postID);

unset($_SESSION['post'], $_SESSION['id'], $_SESSION['image']);
exit();

function saveEditedPost(PDO $db, array $postData, int $postID)
{
    updateDataToDB($db, 'not_public_posts', $postData, ['id' => $postID]);
    goToPage('my_posts');
}

function publishPost(PDO $db, array $postData, int $postID): void
{
    addDataToDB($db, 'public_posts', $postData);
    removeDataToDB($db, 'not_public_posts', ['id' => $postID]);
    goToPage('my_posts');
}