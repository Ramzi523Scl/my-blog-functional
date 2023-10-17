
<?php function Menu($activePage = '') { ?>
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
    <div class="container-fluid container d-flex justify-content-between">
        <a class="navbar-brand" href="http://my-blog2/index.php">
            <img src="http://my-blog2/src/images/logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
    Мой блог
    </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if($activePage === 'index') echo 'active'; ?>" aria-current="page" href="http://my-blog2/index.php">Лента</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($activePage === 'my_posts') echo 'active'; ?>" href="http://my-blog2/src/pages/my_posts.php">Мои посты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($activePage === 'create_post') echo 'active'; ?>" href="http://my-blog2/src/pages/create_post.php">Добавить пост</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Избранные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Админка</a>
                </li>
            </ul>
        </div>


        <?php if($activePage === 'profile'): ?>
            <a href="http://my-blog2/src/function/logout.php" class="profile__link btn btn-danger " role="button">Выйти</a>
        <?php else: ?>
            <a href="http://my-blog2/src/pages/profile.php" class="profile__link btn btn-success mx-2" role="button">Мой Профиль</a>
        <?php endif; ?>

    </div>
</nav>
<?php } ?>
