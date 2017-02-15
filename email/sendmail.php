<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include "classes/class.phpmailer.php"; // include the class name
	include "classes/class.smtp.php";
	
    $public = $_SESSION["public"];
    $public_vein = $public["vein_data"];
	$client = find_public_by_vein_data($public_vein);
	$sender_email =$client["email"]; 
	$otk = one_time_key();
	$_SESSION["otk"] = $otk;
	
	$email_subject = "Authentication Code:";
	$email_body = "Dear sir,\n Your One Time Key is:- $otk . \n Please submit this key to our portal site www.s.edigisign.org to complete signature. Thank you";
	$email_to = $sender_email;
	$mail=new PHPMailer(); // create a new object
	$mail-> IsSMTP(); //enable SMTP
	$mail-> SMTPDebug = 1; //debugging: 1 = errors and messages, 2 = messages only
	$mail-> SMTPAuth = true; //authentication enabled
	$mail-> SMTPSecure = 'ssl'; // Secured transfered enabled REQUIRED for Gmail
	$mail-> Host = "smtp.gmail.com";
	$mail-> Port = 465; // or 465/587
	$mail-> IsHTML(true);
	$mail-> Username = "edigisignservice@gmail.com"; //gmail account name
	$mail-> Password = "edigisign123"; // gmail password
	$mail-> SetFrom("edigisignservice@gmail.com");
	$mail-> Subject = $email_subject;
	$mail-> Body= $email_body;
	$mail-> AddAddress($email_to);
	if(!$mail->Send())
	{
		echo "Mailer Error: ".$mail->ErrorInfo; 
	}else{
		$_SESSION["active_otk_form"]=1;
		redirect_to("../otk_form.php");
	}
		
	
	

?>
