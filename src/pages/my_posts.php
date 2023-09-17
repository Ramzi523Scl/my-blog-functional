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
//var_dump('pages');
//exit();
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

<?php Menu(); ?>

<main class="my-posts">
    <div class="container">
        <div class="my-posts__content">

            <?php RowPosts("Опубликованные посты", $public_posts, true); ?>
            <?php RowPosts("Черновики", $drafts, false); ?>

<!--            <div class="my-posts__item item mt-4 p-3">-->
<!--                <h2 class="item__title mb-4 text-center">Опубликованные посты</h2>-->
<!--                <div class="item__content d-flex flex-wrap">-->
<!---->
<!--                    --><?php //for($i=0; $i < $count_public_posts; $i++) {?>
<!--                        <div class="my-posts__post post mx-3 mb-2 p-2 align-self-stretch d-flex flex-column" id="--><?php //echo $public_posts[$i]['id']; ?><!--">-->
<!--                            <div class="post__name fs-5 fw-medium mb-2">--><?php //echo $public_posts[$i]['name']; ?><!--</div>-->
<!--                            <img class="post__img rounded mx-auto d-block img-fluid" src="../image/--><?php //echo $public_posts[$i]['image']?><!--">-->
<!--                            <div class="post__descr mt-2 flex-grow-1">--><?php //echo $public_posts[$i]['description']?><!--</div>-->
<!--                            <div class="post__date text-end"><i>--><?php //echo $public_posts[$i]['post_date']?><!--</i></div>-->
<!--                            <div class="post_btns d-flex">-->
<!--                                <a class="post__btn btn btn-primary"-->
<!--                                   role="button"-->
<!--                                   href="../pages/post.php?posted=yes&id=--><?php //echo $public_posts[$i]['id']; ?><!--"-->
<!--                                   style="--bs-btn-padding-y: .3rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; width: 100%; ">-->
<!--                                    Открыть</a>-->
<!--                                <a class="post__btn post-delete btn"-->
<!--                                   id="--><?php //echo $public_posts[$i]['id']; ?><!--"-->
<!--                                   role="button"-->
<!--                                   href="../function/delete_post.php?posted=yes&id=--><?php //echo $public_posts[$i]['id']; ?><!--"-->
<!--                                   style="--bs-btn-padding-y: .3rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; padding: 0; margin-left: 3px"-->
<!--                                ><img class="post-delete" src="../image/delete2.png" alt="" height="26"></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    --><?php //} ?>
<!---->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="my-posts__item item">-->
<!--                <h2 class="item__title mb-4 text-center">Черновики</h2>-->
<!--                <div class="item__content d-flex flex-wrap">-->
<!---->
<!--                    --><?php //for($i=0; $i < $count_drafts; $i++) {?>
<!--                        <div class="my-posts__post post mx-3 mb-2 p-2 align-self-stretch d-flex flex-column" id="--><?php //echo $drafts[$i]['id']; ?><!--">-->
<!--                            <div class="post__name fs-5 fw-medium mb-2">--><?php //echo $drafts[$i]['name']; ?><!--</div>-->
<!--                            <img class="post__img rounded mx-auto d-block img-fluid" src="../image/--><?php //echo $drafts[$i]['image']?><!--">-->
<!--                            <div class="post__descr mt-2 flex-grow-1">--><?php //echo $drafts[$i]['description']?><!--</div>-->
<!--                            <div class="post__date text-end"> <i>--><?php //echo $drafts[$i]['post_date']?><!-- </i></div>-->
<!--                            <div class="post_btns d-flex">-->
<!--                                <a class="post__btn btn btn-primary mt-2"-->
<!--                                   role="button"-->
<!--                                   href="../pages/post.php?posted=no&id=--><?php //echo $drafts[$i]['id']; ?><!--"-->
<!--                                   style="--bs-btn-padding-y: .3rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; width: 100%"-->
<!--                                >Открыть</a>-->
<!--                                <a class="post__btn post-delete btn mt-2"-->
<!--                                   id="--><?php //echo $drafts[$i]['id']; ?><!--"-->
<!--                                   role="button"-->
<!--                                   href="../function/delete_post.php?posted=no&id=--><?php //echo $drafts[$i]['id']; ?><!--"-->
<!--                                   style="--bs-btn-padding-y: .3rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; padding: 0; margin-left: 3px"-->
<!--                                ><img class="post-delete" src="../image/delete2.png" alt="" height="26"></a>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    --><?php //} ?>
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</main>

</body>
</html>
