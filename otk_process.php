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
  include "email/classes/class.phpmailer.php"; // include the class name
  include "email/classes/class.smtp.php";

if (isset($_POST['submit'])){
	//$vein_data =$_POST["vein_data"];
	$receiver_email = $_POST["receiver_email"];
	$sender_otk = $_POST["sender_otk"];
	//validation check
	$required_fields = array("receiver_email", "sender_otk");
	validate_presences($required_fields); //if fields blank then insert errors into errors array.
	$fields_with_max_lengths = array("receiver_email" => 35, "sender_otk" => 10);
	validate_max_lengths($fields_with_max_lengths);
	

	if(empty($errors)){
	   $send_otk = $_SESSION["otk"];
	   $query = "select* ";
	   $query .= "from client_info ";
	   $query .= "where email = '{$receiver_email}' ";
	   $query .= "limit 1";
	   $public_set = mysqli_query($connection, $query);
	   confirm_query($public_set);
	   $found_receiver = mysqli_fetch_assoc($public_set);
	   if($send_otk == $sender_otk){
		 if($found_receiver){
		   $public = $_SESSION["public"];
           $sender_vein = $public["vein_data"];
		   $sender_first_name = $public["first_name"];
		   
		   $receiver_vein = $found_receiver["vein_data"];
		   $receiver_email = $found_receiver["email"];
		   
		   $sender = find_public_by_vein_data($sender_vein);
		   $sender_public_key = $sender["public_key"];
		   
		   $combine_key = $sender_public_key.$send_otk;
		   $combine_key = password_encrypt($combine_key);
		   
		   $document_name = $_SESSION["upload_file"];
		   
		   $time = time();
		   
		   
		        $query  = "INSERT INTO public_file (";
				$query .= "  sender_vein, receiver_vein, receiver_email, otk, combine_key, document_name, sign_date_time";
				$query .= ") VALUES (";
				$query .= "  '{$sender_vein}', '{$receiver_vein}', '{$receiver_email}', {$send_otk}, '{$combine_key}', '{$document_name}', '{$time}'";
				$query .= ")";
				$result = mysqli_query($connection, $query);
				
				
				$email_subject = "Authentication Code:";
				$email_body ="Dear Sir,\n $sender_first_name has Recently Signed a Document Using One Time Key for You.\n To Verify this Document Please Submit $sender_first_name's Public Key & One Time Key: $send_otk to www.s.edigisign.org.\n Thank You.";
				$email_to = $receiver_email;
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
					$message = "Mailer Error: ".$mail->ErrorInfo; 
				}else{
					$_SESSION["from_otk_process"]=1;
					redirect_to("signature_pad/return_signature.php");
				}
		   
		 }else{
		  $message = "Unknown Receiver."; 
		 }	
	   }else{
		  $message = "Your One Time Key Is Incorrect."; 
	   }
				
   }elseif(!empty($errors)){
        validate_presences1($required_fields);
		$otk_errors = $errors['sender_otk'];
	    $email_errors = $errors['receiver_email'];
	}
	}else{
		//get request
	}
?>


<title>eDigiSign</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/flexslider.css"/>
    <link href="assets/bxslider/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/animate.css">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>


    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
	<link href="sigPad/css/styles.css" rel="stylesheet" type="text/css" />

      <style>
          .modal-header, h4, .close {
              background-color: #5cb85c;
              color: white !important;
              text-align: center;
              font-size: 30px;
          }

          .modal-footer {
              background-color: #f9f9f9;
          }
		  
		  .form-signin {
				max-width: 400px;
				background:#616D7E;
				
		  }
		  
		  .form-signin h2.form-signin-heading {
		  
               background:#00A8B3;
		  
		  }
		  
		  .clearButton{
			
			display:block;
		  }
		  
      </style>



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  
   <!--header start-->
    <header class="head-section">
      <div class="navbar navbar-default navbar-static-top container">
          <div class="navbar-header">
              <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html">eDigi<span>Sign</span></a>
          </div>
    </header>
    <!--header end-->

   <!--breadcrumbs start-->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <h1 style="color:#F7FE2E;">
              <i class="glyphicon glyphicon-wrench"> </i>
			  Fix The Following Error
            </h1>
          </div>
          <div class="col-lg-8 col-sm-8">
            
          </div>
        </div>
      </div>
    </div>
    <!--breadcrumbs end-->

    
   
	
	<!--container start-->
	<div class="btn btn-lg" ></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="about-carousel wow fadeInLeft">
            <div id="myCarousel" class="carousel slide">
              <!-- Carousel items -->
              <div class="carousel-inner">
                <div class="active item">
                  <img src="img/finger-vein-reader.jpg" alt="">
                  <div class="carousel-caption">
                    <p>
                      Put Your Finger in Right Position.
                    </p>
                  </div>
                </div>
               
              </div>
              <!-- Carousel nav -->
              
            </div>
          </div>
        </div>
		<div class="btn btn-lg" ></div>
        <div class="col-lg-7 about wow fadeInRight">

          <p style="color:red;font-size: 30px;">
          <i class="glyphicon glyphicon-remove"> </i>
		  Errors:
          </p>
		  <div class="btn btn-lg" ></div>
          <ul class="list-unstyled">
            <li style="color:red;font-size: 20px;">
              <i class="glyphicon glyphicon-hand-right">
              </i>
              Put Your Finger Into Vein Reader.
            </li>

            <li style="color:red;font-size: 20px;">
			<i class="glyphicon glyphicon-hand-right">
              </i>
              <?php
			  
			    if(!empty($message)){
			           echo $message;
					 }elseif(!empty($otk_errors) && !empty($email_errors)){
						//echo nl2br("$vein_data_errors. \n $email_errors.");
					   echo $otk_errors;
					   echo nl2br("\n ");
					   print "<i class=\"glyphicon glyphicon-hand-right\"></i>";
				       echo $email_errors;
					  
					 }elseif(!empty($otk_errors)){
						 echo $otk_errors;
					 }elseif(!empty($email_errors)){
						 echo $email_errors;
					 }
			   ?>
             
            </li>
          </ul>
        </div>
      </div>
	  <div class="btn btn-lg" style="height:100px;" ></div>
	  
	  <a class="btn btn-lg btn-login btn-block" style="background-color:#48CFAD;" href="otk_form.php" ><i class="glyphicon glyphicon-ok">
              </i> OK </a>
	</div>		  
    <!--container end-->

          <!--footer start-->
         
          <!--small footer end-->
          <!-- js placed at the end of the document so the pages load faster -->
          <script src="js/jquery-1.8.3.min.js"></script>
          <script src="js/jquery.js"></script>
          <script src="js/bootstrap.min.js"></script>
          <script type="text/javascript" src="js/hover-dropdown.js"></script>
          <script defer src="js/jquery.flexslider.js"></script>
          <script type="text/javascript" src="assets/bxslider/jquery.bxslider.js"></script>

          <script src="js/jquery.easing.min.js"></script>
          <script src="js/link-hover.js"></script>


          <!--common script for all pages-->
          <script src="js/common-scripts.js"></script>
          <script src="js/wow.min.js"></script>
          <script>
              wow = new WOW(
                {
                    boxClass: 'wow',      // default
                    animateClass: 'animated', // default
                    offset: 0          // default
                }
              )
              wow.init();
          </script>
		  
		  <!-- for signature pad -->
		  <script type="text/javascript" src="sigPad/js/jquery-2.1.4.min.js"></script>
		  <script type="text/javascript" src="sigPad/js/flashcanvas.js"></script>
		  <script type="text/javascript" src="sigPad/js/json2.min.js"></script>
          <script type="text/javascript" src="sigPad/js/jquery.signaturepad.min.js"></script>
          <script type="text/javascript" src="sigPad/js/functions.js"></script>





