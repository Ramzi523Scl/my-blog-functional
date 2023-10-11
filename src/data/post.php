<?php
$db = include('../database/connect_db.php');
include('../database/queriesToDB.php');
include('../function/getSegmentsFromURL.php');
include('../function/deletePost.php');
include('../function/definePostTable.php');
include('../function/postSaveSession.php');

session_start();

// Я передавал некую информацию по URL, разбил ее по переменным
$whatToDo = getSegmentsFromURL();
$postID = $_SESSION['id'];
$post = $_SESSION['post'];
$table = definePostTable($post['public-or-draft']);

// При нажатии на ту или иную кнопку, срабатывает соответсвующая функция
if ($whatToDo === 'delete') deletePost($db, $table, $postID);
if ($whatToDo === 'edit') openPageEditPost($post);
if ($whatToDo === 'publish') publishPost($db, (int) $postID);

unset($_SESSION['post']);
goToPage('my_posts');
exit();


function openPageEditPost(array $postInfo): void
{
    // Поля куда пользователь вводит название, описание, текст поста
    $fieldsName = [
        'id',
        'name',
        'description',
        'post_text',
        'image',
    ];
    postSaveSession($fieldsName, $postInfo);
    goToPage('edit_post');
    exit();
}
function publishPost(PDO $db, int $id): void
{
    $post = readDataToDB($db, 'not_public_posts', ['*'], ['id' => $id]);
    addDataToDB($db, 'public_posts', $post);
    removeDataToDB($db, 'not_public_posts', ['id' => $id]);
}