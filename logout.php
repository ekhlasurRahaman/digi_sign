<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
$_SESSION["public"] = null;
$_SESSION["admin_user_name"] = null;
redirect_to("index.php");
?>