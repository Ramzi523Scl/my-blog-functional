
<style>
    .post {
        flex: 0 0 29%;
        max-width: 29%;
    }
    .post__name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .post__descr {
        max-height: 97px;
        white-space: break-spaces;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<?php
function RowPosts(string $header, array $posts, bool $isPublic = null): void
{
    $count_posts = count($posts);
    ?>
    <div class="my-posts__item item mt-4 p-3">
                <h2 class="item__title mb-4 text-center"><?php echo $header; ?></h2>
                <div class="item__content d-flex justify-content-around flex-wrap">

                    <?php for($i=0; $i < $count_posts; $i++) {?>
                        <div class="my-posts__post post mx-3 mb-2 p-2 align-self-stretch d-flex justify-content-between flex-column" id="<?php echo $posts[$i]['id']; ?>">
                            <div class="post__name fs-5 fw-medium mb-2"><?php echo $posts[$i]['name']; ?></div>
                            <img class="post__img rounded mx-auto d-block img-fluid" src="../images/<?php echo $posts[$i]['image']?>">
                            <div class="post__descr mt-2 flex-grow-1"><?php echo $posts[$i]['description']?></div>
                            <div class="post__date text-end"> <i><?php echo $posts[$i]['post_date']?> </i></div>

                            <div class="post_btns d-flex">
                                <a class="post__btn btn btn-primary mt-2"
                                   role="button"
                                   href="../data/my_posts.php/open/<?php echo $posts[$i]['id']; ?>/<?php echo ($isPublic) ? 'public' : 'draft'; ?>"
                                   style="--bs-btn-padding-y: .3rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; width: 100%"
                                >Открыть</a>
                                <a class="post__btn post-delete btn mt-2"
                                   id="<?php echo $posts[$i]['id']; ?>"
                                   role="button"
                                   href="../data/my_posts.php/delete/<?php echo $posts[$i]['id']; ?>/<?php echo ($isPublic) ? 'public' : 'draft'; ?>"
                                   style="--bs-btn-padding-y: .3rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; padding: 0; margin-left: 3px"
                                ><img class="post-delete" src="../images/delete2.png" alt="" height="26"></a>

                            </div>

                        </div>
                    <?php } ?>
                </div>
            </div>
<?php } ?>
