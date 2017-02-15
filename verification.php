<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_function.php"); ?>


<?php
if (isset($_POST['submit'])){
	//$vein_data =$_POST["vein_data"];
	$receiver_otk = $_POST["receiver_otk"];
	$public_key = $_POST["public_key"];
	//validation check
	$required_fields = array("receiver_otk", "public_key");
	validate_presences($required_fields); //if fields blank then insert errors into errors array.
	$fields_with_max_lengths = array("receiver_otk" => 10, "public_key" => 44);
	validate_max_lengths($fields_with_max_lengths);
	
	if(empty($errors)){
		$combine_key = $public_key.$receiver_otk;     //sender public_key
		$public = $_SESSION["public"];//client_info table
		$vein_data= $public["vein_data"];
		$found_file_details = file_verification($vein_data, $receiver_otk, $combine_key);
		
		//data from public_file table
		if($found_file_details){
			$sender_vein        = $found_file_details["sender_vein"];
			$receiver_vein      = $found_file_details["receiver_vein"];
			$receiver_email     = $found_file_details["receiver_email"];
			$otk                = $found_file_details["otk"];
			$document_name      = $found_file_details["document_name"];
			$sign_date_time     = $found_file_details["sign_date_time"];
			
			$sign_date          = strftime("%m/%d/%y", $sign_date_time);
			$sign_time          = strftime("%H:%M:%S %p", $sign_date_time);
			
			//data from client_info table
			
			$sender_info        = find_public_by_vein_data($sender_vein);
			$sender_email       = $sender_info["email"];
			$sender_public_key  = $sender_info["public_key"];
			
			//data from public_info table 
			//               sender
			$sender_data        = find_public_info_by_vein_data($sender_vein);
			$sender_fname       = $sender_data["first_name"];
			$sender_lname       = $sender_data["last_name"];
			$sender_full_name   = $sender_fname." ".$sender_lname;
			
			//               receiver
			$receiver_data      = find_public_info_by_vein_data($receiver_vein);
			$receiver_fname     = $receiver_data["first_name"];
			$receiver_lname     = $receiver_data["last_name"];
			$receiver_full_name = $receiver_fname." ".$receiver_lname;
			
		}else{
			$message = "Your OTK or Public key is incorrect";
		}
	}else{
		validate_presences1($required_fields);
		$public_key_errors = $errors['public_key'];
	    $otk_errors = $errors['receiver_otk'];
		$found_file_details = "sajol";
	}
	
	}else{
		//get request
	}


?>


<title>eDigiSigner</title>

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
	
	<!-- file verification -->
	<link rel="stylesheet" type="text/css" href="css/main.css">

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
              <a class="navbar-brand" href="index.php">eDigi<span>Signer</span></a>
          </div>
    </header>
    <!--header end-->
	<?php 
		if($found_file_details && $found_file_details!=="sajol"){
			echo "<div  style=\"background:#EEE\">\n";
			echo "   <!--breadcrumbs start-->\n";
			echo "    <div class=\"breadcrumbs\">\n";
			echo "      <div class=\"container\">\n";
			echo "        <div class=\"row\">\n";
			echo "          <div class=\"col-lg-4 col-sm-4\">\n";
			echo "            <h1 style=\"color:#F7FE2E;\">\n";
			echo "              <i class=\"glyphicon glyphicon-floppy-saved\"> </i>\n";
			echo "			  Document Validation\n";
			echo "            </h1>\n";
			echo "          </div>\n";
			echo "          <div class=\"col-lg-8 col-sm-8\">\n";
			echo "                    <ol class=\"breadcrumb pull-right\">\n";
			echo "					<a class=\"btn btn-info navbar-right\" href=\"document_signing.php\"> Done <i class=\"glyphicon glyphicon-triangle-left\"></i></a>                      \n";
			echo "                    </ol>       \n";
			echo "          </div>\n";
			echo "        </div>\n";
			echo "      </div>\n";
			echo "    </div>";
    
        
		
			
			echo "<section id=\"pricing-table\">\n";
			echo "            <div class=\"container\">\n";
			echo "                <div class=\"row\">\n";
			echo "                    <div class=\"pricing\">\n";
			echo "                        <div class=\"col-md-4 col-sm-12 col-xs-12\">\n";
			echo "                            <div class=\"pricing-table\">\n";
			echo "                                <div class=\"pricing-header\">\n";
			echo "                                    <p class=\"pricing-title\">Signer Detail's</p>\n";
			echo "                                </div>\n";
			echo "\n";
			echo "                                <div class=\"pricing-list\">\n";
			echo "                                    <ul>\n";
			echo "                                        <li><i class=\"glyphicon glyphicon-user\"></i>$sender_full_name</li>\n";
			echo "                                        <li><i class=\"glyphicon glyphicon-envelope\"></i>$sender_email</li>\n";
			echo "                                        <li style=\"font-size: 10px;\"><i class=\"glyphicon glyphicon-lock\"></i>$sender_public_key</li>\n";
			echo "                                    </ul>\n";
			echo "                                </div>\n";
			echo "                            </div>\n";
			echo "                        </div>\n";
			echo "\n";
			echo "                        <div class=\"col-md-4 col-sm-12 col-xs-12\">\n";
			echo "                            <div class=\"pricing-table\">\n";
			echo "                                <div class=\"pricing-header\">\n";
			echo "                                    <p class=\"pricing-title\">Receiver Detail's</p>\n";
			echo "                                </div>\n";
			echo "\n";
			echo "                                <div class=\"pricing-list\">\n";
			echo "                                    <ul>\n";
			echo "                                        <li><i class=\"glyphicon glyphicon-user\"></i>$receiver_full_name</li>\n";
			echo "                                        <li><i class=\"glyphicon glyphicon-envelope\"></i>$receiver_email</li>\n";
			echo "                                        <li><i class=\"glyphicon glyphicon-tags\"></i>$otk</li>\n";
			echo "                                    </ul>\n";
			echo "                                </div>\n";
			echo "                            </div>\n";
			echo "                        </div>\n";
			echo "\n";
			echo "                        <div class=\"col-md-4 col-sm-12 col-xs-12\">\n";
			echo "                            <div class=\"pricing-table\">\n";
			echo "                                <div class=\"pricing-header\">\n";
			echo "                                    <p class=\"pricing-title\">Document Detail's</p>\n";
			echo "                                </div>\n";
			echo "\n";
			echo "                                <div class=\"pricing-list\">\n";
			echo "                                    <ul>\n";
			echo "                                        <li><i class=\"glyphicon glyphicon-file\"></i>$document_name</li>\n";
			echo "                                        <li><i class=\"glyphicon glyphicon-calendar\"></i>$sign_date</li>\n";
			echo "                                        <li><i class=\"glyphicon glyphicon-time\"></i>$sign_time</li>\n";
			echo "                                    </ul>\n";
			echo "                                </div>\n";
			echo "                            </div>\n";
			echo "                        </div>\n";
			echo "                    </div>\n";
			echo "                </div>\n";
			echo "            </div>\n";
			echo "        </section>";
		
		}else{
			
			echo "<!--breadcrumbs start-->\n";
			echo "    <div class=\"breadcrumbs\">\n";
			echo "      <div class=\"container\">\n";
			echo "        <div class=\"row\">\n";
			echo "          <div class=\"col-lg-4 col-sm-4\">\n";
			echo "            <h1 style=\"color:#F7FE2E;\">\n";
			echo "              <i class=\"glyphicon glyphicon-wrench\"> </i>\n";
			echo "			  Fix The Following Error\n";
			echo "            </h1>\n";
			echo "          </div>\n";
			echo "          <div class=\"col-lg-8 col-sm-8\">\n";
			echo "            \n";
			echo "          </div>\n";
			echo "        </div>\n";
			echo "      </div>\n";
			echo "    </div>\n";
			echo "    <!--breadcrumbs end-->\n";
			echo "\n";
			echo "    \n";
			echo "   \n";
			echo "	\n";
			echo "	<!--container start-->\n";
			echo "	<div class=\"btn btn-lg\" ></div>\n";
			echo "    <div class=\"container\">\n";
			echo "      <div class=\"row\">\n";
			echo "        <div class=\"col-lg-5\">\n";
			echo "          <div class=\"about-carousel wow fadeInLeft\">\n";
			echo "            <div id=\"myCarousel\" class=\"carousel slide\">\n";
			echo "              <!-- Carousel items -->\n";
			echo "              <div class=\"carousel-inner\">\n";
			echo "                <div class=\"active item\">\n";
			echo "                  <img src=\"img/finger-vein-reader.jpg\" alt=\"\">\n";
			echo "                  <div class=\"carousel-caption\">\n";
			echo "                    <p>\n";
			echo "                      Put Your Finger in Right Position.\n";
			echo "                    </p>\n";
			echo "                  </div>\n";
			echo "                </div>\n";
			echo "               \n";
			echo "              </div>\n";
			echo "              <!-- Carousel nav -->\n";
			echo "              \n";
			echo "            </div>\n";
			echo "          </div>\n";
			echo "        </div>\n";
			echo "		<div class=\"btn btn-lg\" ></div>\n";
			echo "        <div class=\"col-lg-7 about wow fadeInRight\">\n";
			echo "\n";
			echo "          <p style=\"color:red;font-size: 30px;\">\n";
			echo "          <i class=\"glyphicon glyphicon-remove\"> </i>\n";
			echo "		  Errors:\n";
			echo "          </p>\n";
			echo "		  <div class=\"btn btn-lg\" ></div>\n";
			echo "          <ul class=\"list-unstyled\">\n";
			echo "            <li style=\"color:red;font-size: 20px;\">\n";
			echo "              <i class=\"glyphicon glyphicon-hand-right\">\n";
			echo "              </i>\n";
			echo "              Please submit sender public key.\n";
			echo "            </li>\n";
			echo "\n";
			echo "            <li style=\"color:red;font-size: 20px;\">\n";
			echo "			<i class=\"glyphicon glyphicon-hand-right\">\n";
			echo "              </i>\n";
		
			  
			    if(!empty($message)){
			           echo $message;
					 }elseif(!empty($public_key_errors) && !empty($otk_errors)){
						//echo nl2br("$vein_data_errors. \n $email_errors.");
					   echo $public_key_errors;
					   echo nl2br("\n ");
					   print "<i class=\"glyphicon glyphicon-hand-right\"></i>";
				       echo $otk_errors;
					  
					 }elseif(!empty($public_key_errors)){
						 echo $public_key_errors;
					 }elseif(!empty($otk_errors)){
						 echo $otk_errors;
			    	 }
				
			echo "             \n";
			echo "            </li>\n";
			echo "          </ul>\n";
			echo "        </div>\n";
			echo "      </div>\n";
			echo "	  <div class=\"btn btn-lg\" style=\"height:100px;\" ></div>\n";
			echo "	  \n";
			echo "	  <a class=\"btn btn-lg btn-login btn-block\" style=\"background-color:#48CFAD;\" href=\"document_signing.php\" ><i class=\"glyphicon glyphicon-ok\">\n";
			echo "              </i> OK </a>\n";
			echo "	</div>		  \n";
			echo "    <!--container end-->\n";

		}
		
		?>
		
		
		
		
</div>
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



