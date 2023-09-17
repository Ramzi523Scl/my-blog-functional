<?php
$db = include("../database/connect_db.php");
include("../database/queriesToDB.php");
include ("../function/definePostTable.php");

session_start();

// Получение url пути
$path = getPath();

// Получаю нужную информацию о посте через url
// К примеру: http://my-blog2/src/pages/my_posts.php/open/12/public
// Где open - говорит, что пользователь хочет открыть пост
// 12 - это id поста, который нужно открыть
// public - говорит в какой таблице в бд искать пост
[$whatToDo, $id, $publicOrDraft] = explode('/', $path);
$table = definePostTable($publicOrDraft);

// Тут решаю какую функцию запустить, в зависимости от того что хочет пользователь
if ($whatToDo === 'open') openPost($db, $table, (int) $id);
if ($whatToDo === 'delete') deletePost($db, $table, (int) $id);
exit();



function getPath(): string
{
    return str_replace($_SERVER['SCRIPT_NAME'] . '/', "",$_SERVER['REQUEST_URI']);
}

function openPost(PDO $db, string $table, int $id ): void
{
    $post = readDataToDB($db, $table, ['*'], ['id' => $id]);
    $_SESSION['post'] = $post;
    $url = 'http://my-blog2/src/pages/' . 'post.php';
    header("Location: $url");
}

function deletePost(PDO $db, string $table, int $id): void
{
    removeDataToDB($db, $table, ['id' => $id]);

    $url = $_SERVER['HTTP_REFERER'];
    header("Location: $url");
}
