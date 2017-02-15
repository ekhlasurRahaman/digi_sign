<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["public"])){
		redirect_to("index.php");
	}
?>
<?php
		$vein_data = $_GET['vein_data'];
		$email = $_GET['email'];
		delete_contact($vein_data, $email);
		redirect_to('contact.php');	
?>