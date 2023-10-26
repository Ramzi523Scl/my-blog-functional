<?php
$db = include(__DIR__ . "/../database/connect_db.php");
include(__DIR__ . "/../database/queriesToDB.php");
include(__DIR__ . "/../components/menu.php");
include(__DIR__ . "/../function/generateMenu.php");

session_start();
$menuInfo = [
    ['name' => 'Профиль', 'link' => 'http://my-blog2/src/data/user_view.php/profile', 'active' => true],
    ['name' => 'Публикации', 'link' => 'http://my-blog2/src/data/user_view.php/publications', 'active' => false],
    ['name' => 'Комментарии', 'link' => 'http://my-blog2/src/data/user_view.php/comments', 'active' => false],
    ['name' =>'Друзья', 'link' =>'http://my-blog2/src/data/user_view.php/friends', 'active' => false]
];
$layout = $_SESSION['layout'];
$nick = $_SESSION['another-nick'];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/common.css" >
    <link rel="stylesheet" href="../css/user_view.css" >

    <title><?php echo 'user name';?></title>
</head>
<body>

<?php Menu();?>

<main class="user">
    <div class="container">
        <div class="user__content">
            <div class="user__card user__item">
                <img src="../images/ava.svg" alt="" height="70">
                <br>
                <span>@<?php echo $nick; ?></span>
                <p>Пользователь</p>
            </div>
            <?php echo $layout;?>
        </div>
    </div>
</main>

</body>
</html>
