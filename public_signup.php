<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_function.php"); ?>

<?php
if (isset($_POST['submit'])){
	$vein_data =$_POST["vein_data"];
	$email = $_POST["email"];	
	//validation check
	$required_fields = array("vein_data", "email");
	validate_presences($required_fields); //if fields blank then insert errors into errors array.
	$fields_with_max_lengths = array("vein_data" => 100, "email" => 35);
	validate_max_lengths($fields_with_max_lengths);
	

	if(empty($errors)){
		$query = "select* ";
		$query .= "from public_info ";
		$query .= "where vein_data = '{$vein_data}' ";
		$query .= "limit 1";
		$public_set = mysqli_query($connection, $query);
		confirm_query($public_set);
		$found_public = mysqli_fetch_assoc($public_set);	

			if ($found_public) {
			//redirect_to("index.php");
			    $public_key = random_public_key();
				$query  = "INSERT INTO client_info (";
				$query .= "  email, vein_data, public_key";
				$query .= ") VALUES (";
				$query .= "  '{$email}', '{$vein_data}', '{$public_key}'";
				$query .= ")";
				$result = mysqli_query($connection, $query);
				
			  if ($result) {
				//$_SESSION["public_name"]= $found_public["first_name"];
				//$_SESSION["vein_data"]= $found_public["vein_data"];
				$client = find_public_by_vein_data($vein_data);
		        $_SESSION["client"] =$client;
				
				$_SESSION["public"]= $found_public;
				$_SESSION["file_upload"]=0;
				redirect_to("document_signing.php");
			  }else{
					$message = "You Are Already Registered.Try To Login.";
				   }
    	    } else {
			   // Client is not registered in public_info.
			  $message = "You are not Registered. Please Contact to the Public Register Office.";
	 }
   }elseif(!empty($errors)){
        validate_presences1($required_fields);
		$vein_data_errors = $errors['vein_data'];
	    $email_errors = $errors['email'];
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
					 }elseif(!empty($vein_data_errors) && !empty($email_errors)){
						//echo nl2br("$vein_data_errors. \n $email_errors.");
					   echo $vein_data_errors;
					   echo nl2br("\n ");
					   print "<i class=\"glyphicon glyphicon-hand-right\"></i>";
				       echo $email_errors;
					  
					 }elseif(!empty($vein_data_errors)){
						 echo $vein_data_errors;
					 }elseif(!empty($email_errors)){
						 echo $email_errors;
					 }
			   ?>
             
            </li>
          </ul>
        </div>
      </div>
	  <div class="btn btn-lg" style="height:100px;" ></div>
	  
	  <a class="btn btn-lg btn-login btn-block" style="background-color:#48CFAD;" href="index.php" ><i class="glyphicon glyphicon-ok">
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




