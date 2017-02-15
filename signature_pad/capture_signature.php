<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["public"])){
		redirect_to("../index.php");
	}
?>
<?php
$json_sig_data = $_POST['output'];

$public = $_SESSION["public"];
$client_vein = $public["vein_data"];

    $query  = "INSERT INTO client_signature (";
	$query .= " vein_data ,signature";
	$query .= ") VALUES (";
	$query .= " '{$client_vein}','{$json_sig_data}'";
	$query .= ")";
	$result = mysqli_query($connection, $query);
	
	if($result){
		echo "Json Data is stored in the database .";
		redirect_to("../document_signing.php");
	}else{
		$query  = "UPDATE client_signature";
		$query .= " set signature = '{$json_sig_data}'";
		$query .= " where vein_data ='{$client_vein}'";
		$result = mysqli_query($connection, $query);
			if($result){
				$_SESSION["message"]= "Success.";
				redirect_to("../document_signing.php");
			  }
	    }	
//header('Location: http://localhost/signature_pad/capture_signature.php');
?>

