<?php include_once ('elements/header.php'); ?>
<h1>Test Burst</h1>
<form method="post" action="<?php echo ROOT_URL_WITH_INDEX; ?>send">
Number: <input type="text" name="number" value="" /><br />
Text:
<textarea name="message" maxlength="255"></textarea>
    <br /><br /><br />
    <input type="submit" name="submit" value="submit" />
</form>
<?php include_once ('elements/footer.php'); ?>