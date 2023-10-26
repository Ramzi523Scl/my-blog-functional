<?php
$db = include "src/database/connect_db.php";
include('src/database/queriesToDB.php');
include "src/components/menu.php";
session_start();

$posts = readDataToDB($db, 'public_posts', '*', [], true);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/common.css" >
    <link rel="stylesheet" href="src/css/index.css" >

    <title>Лента постов</title>
</head>
<body>

<!--импортирует меню-->
<?php Menu('index');?>

<main class="posts">
    <div class="container">
        <div class="posts__content">
            <?php for($i=0; $i < count($posts); $i++) {
                $user_id = (int) $posts[$i]['author_id'];

                $nick = readDataToDB($db, 'users_login', 'nickname', ['id' => $user_id]);
                $nick = $nick['nickname'];
                ?>
                <div class="posts__post post p-4">
                    <div class="post__item post__author">
                        <img class="post__ava" src="src/images/ava.svg" height="23" alt="">
                        <a class="post__nick" href="src/data/user_view.php?nick=<?php echo $nick?>"><?php echo $nick?></a>
                        <i class="post__date"><?php echo $posts[$i]['post_date']?></i>
                    </div>
                    <div class="post__title post__item"><?php echo $posts[$i]['name']?></div>
                    <div class="post__img post__item "><img class="img-fluid" src="src/images/<?php echo $posts[$i]['image']?>" alt=""></div>
                    <div class="post__description post__item"><?php echo $posts[$i]['description']?></div>
                    <a class="post__btn post__item" href="src/pages/read_post.php?id=<?php echo $posts[$i]['id'];?>">Читать дальше</a>
                </div>
            <?php }?>

        </div>
    </div>
</main>

</body>
</html>

