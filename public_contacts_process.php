<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/validation_function.php"); ?>

<?php
if (isset($_POST['submit'])){
	$name = $_POST["name"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$message = $_POST["message"];
	//validation check
	$required_fields = array("name", "email","phone", "message");
	validate_presences($required_fields); //if fields blank then insert errors into errors array.
	$fields_with_max_lengths = array("name" => 35, "email" => 35, "phone" => 15, "message" => 100);
	validate_max_lengths($fields_with_max_lengths);
	if(empty($errors)){
	$query  = "INSERT INTO public_contacts (";
	$query .= " name ,email ,phone ,message";
	$query .= ") VALUES (";
	$query .= " '{$name}','{$email}','{$phone}','{$message}'";
	$query .= ")";
	$result = mysqli_query($connection, $query);	
    if ($result) {
		
		// Success
		$_SESSION["message"] = "success";
		redirect_to("public_contacts.php");
    	} else {
		// Failure
		 $_SESSION["message"] = "failure";
		 redirect_to("public_contacts.php");
		//die("Database query failed. " . mysqli_error($connection));
	   }
}elseif(!empty($errors)){
		validate_presences1($required_fields);
		validate_max_lengths($fields_with_max_lengths);
		$_SESSION["errors"] = "errors";
		redirect_to("public_contacts.php");
	}	
}else{
	//GET Request
}
?>