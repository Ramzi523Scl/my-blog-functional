
<?php function Field($tag, $blockName, $titleText) { ?>

    <div class="post__item post__name d-flex flex-column">
        <label class="form-label px-2"><?php echo $titleText; ?></label>
        <<?php echo $tag; ?>
            type="text"
            class="form-control <?php if ($_SESSION[$blockName . '-error']) echo 'error-input';?>"
            <?php if ($tag === 'textarea') echo 'cols="50" rows="20"';
            else echo 'style="width: 100%;"'?>
            name="<?php echo $blockName; ?>"
            <?php if ($tag === 'textarea') echo ">$_SESSION[$blockName]</textarea>";
                  else echo "value='$_SESSION[$blockName]'>"; ?>
        <?php unset($_SESSION[$blockName], $_SESSION[$blockName . '-error']); ?>
    </div>

<?php
} ?>