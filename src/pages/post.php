<?php
include('../function/userLoggedIn.php');
include("../components/menu.php");
include("../components/buttons.php");
include("../function/goToPage.php");
include("../function/checkAccessToThisPage.php");

session_start();
userLoggedIn();

if (!checkAccessToThisPage('my_posts')) goToPage('my_posts');

$post = $_SESSION['post'];
$nick = $_SESSION['user']['nick'];

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
    <title><?php echo $post['name'];?></title>
</head>
<body>

<?php Menu();?>

<main class="post">
    <div class="container">

        <div class="post__content">
            <h2 class="post__name post__item"><?php echo $post['name'];?></h2>
            <div class="post__img post__item">
                <img class="img-fluid" src="../images/<?php echo $post['image'];?>">
            </div>
            <h4 class="post__description post__item"><?php echo $post['description'];?></h4>
            <div class="post__text post__item"><?php echo $post['post_text'];?></div>
            <div class="post__date post__item">Пост написан: <i class=""><?php echo $post['post_date'];?></i></div>
        </div>

        <?php Buttons($post['btns']); ?>
    </div>
</main>

</body>
</html>
