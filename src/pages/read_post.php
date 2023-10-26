<?php
$db = include(__DIR__ . "/../database/connect_db.php");
include(__DIR__ . "/../database/queriesToDB.php");
include(__DIR__ . "/../components/menu.php");
session_start();

$post_id = $_GET['id'];
$post = readDataToDB($db, 'public_posts', ['*'], ['id' => $post_id]);
$nick = readDataToDB($db, 'users_login', ['nickname'], ['id' => $post['author_id']]);
$nick = $nick['nickname'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/common.css" >
    <link rel="stylesheet" href="../css/post.css" >
    <link rel="stylesheet" href="../css/read_post.css" >
    <title><?php echo $post['name'];?></title>
</head>
<body>

<?php Menu('index');?>

<main class="post">
    <div class="container">
        <div class="post__content">
            <div class="post__author post__item" >
                <img class="post__ava" src="../images/ava.svg" height="23">
                <a class="post__nick"><?php echo $nick;?></a>
                <i class="post__date"><?php echo $post['post_date'];?></i>
            </div>
            <h2 class="post__name post__item"><?php echo $post['name'];?></h2>
            <div class="post__img post__item">
                <img class="img-fluid" src="../images/<?php echo $post['image'];?>">
            </div>
            <h4 class="post__description post__item"><?php echo $post['description'];?></h4>
            <div class="post__text post__item"><?php echo $post['post_text'];?></div>
            <div class="post__date post__item">Пост написан: <i class=""><?php echo $post['post_date'];?></i></div>
        </div>
    </div>
</main>

</body>
</html>
