<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("signature_to_image.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["public"])){
		redirect_to("../index.php");
	}
?>
<?php
		$public = $_SESSION["public"];
        $client_vein = $public["vein_data"];
		$request_from_otk_process = $_SESSION["from_otk_process"];
		
        $query  = "SELECT * ";
		$query .= "FROM client_signature ";
		$query .= "where vein_data = '$client_vein'";
		$signature_set = mysqli_query($connection, $query);
		$signature_data = mysqli_fetch_assoc($signature_set);
		$json_sig_data =$signature_data["signature"];
		$sig_image_data = sigJsonToImage($json_sig_data);    //json sign data converted into PNG image data
        imagepng($sig_image_data, 'public_signature.png');          //PNG image data save as signature.png
        if($request_from_otk_process == 0){
		echo stripslashes($json_sig_data); 
		}                  //Un-quotes a quoted string
		
		if($request_from_otk_process == 1){
		$_SESSION["active_otk_form"]=0;
		redirect_to("../download.php");
		};
?>