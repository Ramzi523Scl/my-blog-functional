
<?php function Menu() { ?>
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
    <div class="container-fluid container d-flex justify-content-between">
        <a class="navbar-brand" href="../../index.php">
            <img src="../images/logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
    Мой блог
    </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="../../index.php">Лента</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_posts.php">Мои посты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_post.php">Добавить пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Избранные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Админка</a>
                </li>
            </ul>
        </div>
        <a href="../function/logout.php" class="profile__link btn btn-danger " role="button">Выйти</a>

    </div>
</nav>
<?php } ?>
