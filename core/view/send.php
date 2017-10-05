<?php include_once ('elements/header.php'); ?>
    <h1><?php if ($error) :
    echo $error; ?><a href="<?php echo ROOT_URL_WITH_INDEX; ?>home">Back</a> <?php
    elseif (true === $success) :
    ?>Message Successfully Sent.<?php
    endif; ?></h1>
<?php include_once ('elements/footer.php'); ?>