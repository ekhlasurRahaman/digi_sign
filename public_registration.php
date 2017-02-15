<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["admin_user_name"])){
		redirect_to("index.php");
	}
?>
<?php require_once("includes/validation_function.php"); ?>

<?php
if (isset($_POST['submit'])){
	$vein_data = $_POST["vein_data"];
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$gender = $_POST["gender"];
	$age = $_POST["age"];
	$marital_status = $_POST["marital_status"];
	$occupation = $_POST["occupation"];
	$organization = $_POST["organization"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	
	//validation check
	$required_fields = array("vein_data", "first_name", "last_name", "gender", "age", "marital_status", "occupation", "organization", "email", "address");
	validate_presences($required_fields); //if fields blank then insert errors into errors array.
	
	$fields_with_max_lengths = array("vein_data" => 100, "first_name" =>30, "last_name" =>30, "age" =>3, "marital_status" =>3, "occupation" => 40, "organization" =>50, "email" =>35, "address" =>70);
	validate_max_lengths($fields_with_max_lengths);
		
		
		if(empty($errors)){
		$query  = "INSERT INTO public_info (";
		$query .= "  vein_data, first_name, last_name, gender, age, metrial_status, occupation, organization, email, address";
		$query .= ") VALUES (";
		$query .= "  '{$vein_data}', '{$first_name}', '{$last_name}', '{$gender}', {$age}, '{$marital_status}', '{$occupation}', '{$organization}', '{$email}', '{$address}'";
		$query .= ")";

	    $result = mysqli_query($connection, $query);
		
		if ($result) {
		
		// Success
		$_SESSION["message"] = "success";//"Congratulation !!! You Are Successfully Registered.";
		redirect_to("public_registration_form.php");
    	} else {
		// Failure
		 $_SESSION["message"] = "failure";//"Sorry ! You Are Registered Or Your Email Address is Incorrect.";
		 redirect_to("public_registration_form.php");
		//die("Database query failed. " . mysqli_error($connection));
	   }
      }elseif(!empty($errors)){
		validate_presences1($required_fields);
		validate_max_lengths($fields_with_max_lengths);
		$_SESSION["errors"] = $errors;//insert errors array into session.
		redirect_to("public_registration_form.php");
	}
}
?>
