<?php
include('../components/menu.php');
include('../components/field.php');
include('../components/buttons.php');
include('../function/userLoggedIn.php');
include('../function/getWarning.php');
include('../function/getButtons.php');

session_start();
userLoggedIn();

$post = $_SESSION['post'];

$condition = $post['public-or-draft'] === 'public';
$buttons = ($condition) ? array(['clear'], ['publish']) : array(['clear', 'save'], ['publish']);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/src/css/common.css" >
    <link rel="stylesheet" href="/src/css/create_post.css" >
    <title>Редактировать пост</title>
</head>
<body>

<?php Menu('my_posts'); ?>


<main class="post">
    <div class="container">
        <div class="post__content">
            <form action="../data/edit_post.php"  method="post" class="post__form d-flex flex-column">
                <!--предупреждение об ошибке-->
                <?php getWarning('edit-post');?>

                <!--Выводит список полей-->
                <?php
                $fields = [
                    ['input', 'name', 'Название текста'],
                    ['input', 'description', 'Краткое описание поста'],
                    ['textarea', 'post_text', 'Текст поста'],
                ];
                foreach ($fields as $field) Field($field[0], $field[1], $field[2]);
                ?>

                <?php if($_SESSION['image']): ?>
                    <p class="text-center my-5 fs-3 fw-bold text-decoration-underline">Предыдущее фото</p>
                    <img class="post__item post__img mx-auto" src="../images/<?php echo $_SESSION['image'];?>" alt="" width="300">
                <?php else: ?>
                    <p class="text-center my-5 fs-3 fw-bold text-decoration-underline">Изображение было не выбрано</p>
                <?php endif; ?>
                <input type="file" class="post__item post__img" name="image">


                <?php Buttons($buttons, 'input'); ?>

            </form>
        </div>
    </div>
</main>

</body>
</html>

