<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["public"])){
		redirect_to("index.php");
	}

?>
<?php require_once("includes/validation_function.php"); ?>
<?php
if (isset($_POST['submit'])){
	//$vein_data =$_POST["vein_data"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	//validation check
	$required_fields = array("name", "email");
	validate_presences($required_fields); //if fields blank then insert errors into errors array.
	$fields_with_max_lengths = array("name" => 35, "email" => 35);
	validate_max_lengths($fields_with_max_lengths);
	$public = $_SESSION["public"];
    $vein_data= $public["vein_data"];
	$status = registered_contact($email);
	if(empty($errors)){
	   $query  = "INSERT INTO contact (";
		$query .= "  vein_data, name, email, status";
		$query .= ") VALUES (";
		$query .= "  '{$vein_data}', '{$name}', '{$email}', '{$status}'";
		$query .= ")";

	    $result = mysqli_query($connection, $query);
		if ($result) {
		
		// Success
		$_SESSION["message"] = "success";
		redirect_to("contact.php");
    	} else {
		// Failure
		 $_SESSION["message"] = "failure";
		 redirect_to("contact.php");
		//die("Database query failed. " . mysqli_error($connection));
	   }
	}elseif(!empty($errors)){
		validate_presences1($required_fields);
		validate_max_lengths($fields_with_max_lengths);
		$_SESSION["errors"] = "errors";
		redirect_to("contact.php");
	}	
}else{
	//GET Request
}
?>