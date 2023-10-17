<?php
include('../components/menu.php');
include('../components/field.php');
include('../function/userLoggedIn.php');
include('../function/getWarning.php');

session_start();
userLoggedIn();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/common.css" >
    <link rel="stylesheet" href="../css/create_post.css" >
    <title>Добавление постов</title>
</head>
<body>


<?php Menu('create_post'); ?>

<main class="post">
    <div class="container">
        <div class="post__content">
            <form action="../data/create_post.php"  method="post" class="post__form d-flex flex-column">

                <!--предупреждение об ошибке-->
                <?php getWarning('create-post');?>

                <!--Выводит список полей-->
                <?php
                    $fields = [
                        ['input', 'post-title', 'Название текста'],
                        ['input', 'post-descr', 'Краткое описание поста'],
                        ['textarea', 'post-text', 'Текст поста'],
                    ];
                    foreach ($fields as $field) Field($field[0], $field[1], $field[2]);
                ?>

                <input type="file" class="post__item post__img" name="post-img">
                <div class="post__item post__btns d-flex justify-content-between">
                    <div>
                        <input class="post__btn btn btn-danger" type="submit" name="clear-btn" value="Очистить">
                        <input class="post__btn btn btn-warning" type="submit" name="save-btn" value="Сохранить">
                    </div>
                    <div>
                        <input class="post__btn btn btn-success" type="submit" name="post-btn" value="Опубликовать ->">
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>

</body>
</html>
