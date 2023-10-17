<?php
include('../components/menu.php');
include('../components/rowPosts.php');
include('../function/userLoggedIn.php');
include('../function/getWarning.php');
include('../database/queriesToDB.php');
$db = include('../database/connect_db.php');


session_start();
userLoggedIn();

$public_posts = readDataToDB($db, 'public_posts', ['*'], ['author_id' => $_SESSION['user']['id']], true);
$drafts = readDataToDB($db, 'not_public_posts', ['*'], ['author_id' => $_SESSION['user']['id']], true);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/common.css" >
    <link rel="stylesheet" href="../css/my_posts.css" >
    <style>
    </style>
    <title>Мои посты</title>
</head>
<body>

<?php Menu('my_posts'); ?>

<main class="my-posts">
    <div class="container">
        <div class="my-posts__content">

            <!-- Создает список постов -->
            <?php RowPosts("Опубликованные посты", $public_posts, true); ?>
            <?php RowPosts("Черновики", $drafts, false); ?>

        </div>
    </div>
</main>

</body>
</html>
