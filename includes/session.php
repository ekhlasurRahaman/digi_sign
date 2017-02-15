<?php
session_start();
function message(){ //retrive message from session
	if(isset($_SESSION["message"])){
      	$message = $_SESSION["message"];
		 //clear message after use
		 $_SESSION["message"] = null;
		 return $message;
		 }
}

function errors(){                          //Insert errors into variables($errors) from session.
	if(isset($_SESSION["errors"])){
		 $errors = $_SESSION["errors"];
		 //clear message after use
		 $_SESSION["errors"] = null;
		 return $errors;
		 }
      }

?>