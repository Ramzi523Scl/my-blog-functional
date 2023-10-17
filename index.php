<?php
$db = include "src/database/connect_db.php";
include('src/database/queriesToDB.php');

include "src/components/menu.php";
include "src/function/tt.php";
session_start();

$posts = readDataToDB($db, 'public_posts', '*', [], true);
//tt($posts);
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
    <style>

        .posts {
            background-color: #f0f0f0;
            padding: 50px 5px;
        }

        .post {
            background-color: white;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
        }
        .post:not(:last-child) {
            margin: 0 0 50px;
        }
        .post__item {
            margin-bottom: 10px;
        }
        .post__nick {
            text-decoration: none;
            color: black;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: ease 0.3s;
        }
        .post__nick:hover {
            color: #64ded7;
        }
        .post__date {
            font-size: 13px;
            color: #909090;
        }
        .post__title {
            font-weight: bold;
            font-size: 25px;
        }
        .post__description {
            font-size: 16px;
        }
        .post__img {
            margin: 20px;
        }
        .post__img img {
            display: block;
            margin: 0 auto;
            max-height: 400px;
        }
        .post__btn {
            text-decoration: none;
            border: 2px solid #64ded7;
            border-radius: 5px;
            color: #64ded7;
            text-align: center;
            width: 130px;
            padding: 5px;
            cursor: pointer;
            transition: ease 0.8s;
        }
        .post__btn:hover {
            background-color: #64ded7;
            color: white;
        }

    </style>

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
                        <a class="post__nick"><?php echo $nick?></a>
                        <i class="post__date"><?php echo $posts[$i]['post_date']?></i>
                    </div>
                    <div class="post__title post__item"><?php echo $posts[$i]['name']?></div>
                    <div class="post__img post__item "><img class="img-fluid" src="src/images/<?php echo $posts[$i]['image']?>" alt=""></div>
                    <div class="post__description post__item"><?php echo $posts[$i]['description']?></div>
                    <a class="post__btn post__item" href="src/pages/post.php?id=<?php echo $posts[$i]['id'];?>">Читать дальше</a>
                </div>
            <?php }?>

        </div>
    </div>
</main>

</body>
</html>

