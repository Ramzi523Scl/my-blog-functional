
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .post__btns {
            padding: 0 20px;
        }
    </style>

<?php function Buttons(array $btns): void
{
    [$clear, $delete, $save, $edit, $publish] = false;
    foreach ($btns as $btn) {
        if ($btn === 'clear') $clear = true;
        if ($btn === 'delete') $delete = true;
        if ($btn === 'save') $save = true;
        if ($btn === 'edit') $edit = true;
        if ($btn === 'publish') $publish = true;
    }
    ?>
    <div class="post__btns d-flex justify-content-between">
        <div>
            <?php if ($clear):?>
                <a href="../data/post.php/clear"
                   class="post__btn btn btn-danger"
                   role="button"
                >Очистить</a>
            <?php endif;?>

            <?php if ($delete):?>
            <a href="../data/post.php/delete"
               class="post__btn btn btn-danger"
               role="button"
            >Удалить</a>
            <?php endif;?>

            <?php if ($save): ?>
            <a href="../data/post.php/save"
               class="post__btn btn btn-warning"
               role="button"
            >Сохранить</a>
            <?php endif;?>
            <?php if ($edit):?>
            <a href="../data/post.php/edit"
               class="post__btn btn btn-info"
               role="button"
            >Редактировать</a>
            <?php endif;?>
        </div>

        <div>
            <?php if ($publish): ?>
            <a href="../data/post.php/publish"
               class="post__btn btn btn-success"
               role="button"
            >Опубликовать -></a>
            <?php endif;?>
        </div>
    </div>
<?php }?>