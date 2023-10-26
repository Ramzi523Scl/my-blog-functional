
<?php
include (__DIR__ . "/../function/getWarning.php");
include(__DIR__ . "/../components/menu.php");
session_start();

;?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/common.css" >
    <link rel="stylesheet" href="../css/sign_in.css" >
    <title>Авторизация</title>
</head>
<body>
<?php Menu();?>
<div class="sing-in">
    <div class="container">
        <div class="sing-in__body">
            <div class="sing-in__content">
                <div class="sing-in__title mb-4 fw-bold">Войдите в свой профиль</div>

<!--                Предупреждение об ошибке введенных данных-->
                <?php getWarning('sign');?>

                <form class="sing-in__form" action="../data/sign_in.php" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" name="nickname" placeholder="Никнейм">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Пароль">
                    </div>
                    <div class="mb-4">
                        <a href="" class="sing-in__link sing-in__link-pass">Не помню пароль</a>
                    </div>
                    <button type="submit" class="sing-in__btn btn btn-primary">Отправить</button>
                </form>
                <div class="sing-in__link sing-in__link-resit">Ещё нет профиля? <a href="register.php">Зарегистрируйтесь</a></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


