<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["admin_user_name"])){
		redirect_to("index.php");
	}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="author" content="cosmic">
    <meta name="keywords" content="Bootstrap 3, Template, Theme, Responsive, Corporate, Business">
    <link rel="shortcut icon" href="img/favicon.png">

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
	
	 <!--for sweet alert message-->
	   <script src="includes/message_alert/sweetalert-dev.js"></script>
       <link rel="stylesheet" href="includes/message_alert/sweetalert.css">

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
		  
	
			  input[type=text], textarea {
			  -webkit-transition: all 0.30s ease-in-out;
			  -moz-transition: all 0.30s ease-in-out;
			  -ms-transition: all 0.30s ease-in-out;
			  -o-transition: all 0.30s ease-in-out;
			  outline: none;
			  padding: 3px 0px 3px 3px;
			  margin: 5px 1px 3px 0px;
			  border: 1px solid #DDDDDD;
			  
			}
			 
			  input[type=text]:focus, textarea:focus {
			  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
			  padding: 3px 0px 3px 3px;
			  margin: 5px 1px 3px 0px;
			  border: 1px solid rgba(81, 203, 238, 1);
			}
				
      </style>



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    
    <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1 style="text-transform:none;">eDigi<span style="color:#48cfad;">Signer</span> Admin:<span style="color:#F6F619"> <?php echo $_SESSION["admin_user_name"];?></span></h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                        <a style ="color: white;" href="index.php">Logout <i class="glyphicon glyphicon-off" style ="color: red;"></i></a>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->

	
	 <!-- Form errors Start -->
	
	  <?php 
      	//Insert errors into variables($errors) from session.
      	$errors = errors();
		$message = message()
      ?>

    <!-- Form errors End -->

	
    <!--container start-->
    <div class="registration-bg">
        <div class="container">

            <form class="form-signin wow fadeInUp" method="post" action="public_registration.php">
                <h2 class="form-signin-heading">Public Registration Form</h2>
                <div class="login-wrap">
                    <p>Enter personal details</p>
					<h6 style="color:red"> <?php if (strlen($message)== 62){echo $message;} ?></h6>
					<h6 style="color:green"> <?php if (strlen($message)== 51){echo $message;} ?></h6>
					<input type="text" class="form-control" style="border-color:" name="vein_data" value="" placeholder="Vein Data">
					<h5 style="color:red"><?php echo $errors['vein_data']; ?></h5>
					<input type="text" class="form-control" name="first_name" value="" placeholder="First Name">
					<h5 style="color:red"><?php echo $errors['first_name']; ?></h5>
					<input type="text" class="form-control" name="last_name" value="" placeholder="Last Name">
					<h5 style="color:red"><?php echo $errors['last_name']; ?></h5>
					<div class="radios">
                        <label class="label_radio col-lg-6 col-sm-6" for="radio">
                            <input name="gender" id="radio-01" value="M" type="radio" checked> Male
                        </label>
                        <label class="label_radio col-lg-6 col-sm-6" for="radio">
                            <input name="gender" id="radio-02" value="F" type="radio"> Female
                        </label>
                    </div>
					<input type="text" class="form-control" name="age" value="" placeholder="Age">
					<h5 style="color:red"><?php echo $errors['age']; ?></h5>
					<input type="text" class="form-control" name="marital_status" value="" placeholder="Marital Status: Yes or No">
					<h5 style="color:red"><?php echo $errors['marital_status']; ?></h5>
					<input type="text" class="form-control" name="occupation" value="" placeholder="Occupation">
					<h5 style="color:red"><?php echo $errors['occupation']; ?></h5>
					<input type="text" class="form-control" name="organization" value="" placeholder="Organization">
					<h5 style="color:red"><?php echo $errors['organization']; ?></h5>
					<input type="text" class="form-control" name="email" value="" placeholder="Email">
					<h5 style="color:red"><?php echo $errors['email']; ?></h5>
					<input type="text" class="form-control" name="address" value="" placeholder="Address">
					<h5 style="color:red"><?php echo $errors['address']; ?></h5>
                    
					<input class="btn btn-lg btn-login btn-block" type="submit" name="submit" value="Submit">
                   
                </div>
            </form>

        </div>
     </div>
    <!--container end-->

          <!--footer start-->
          <footer class="footer">
          </footer>
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
			  
			  
			 var message = "<?php echo $message?>" ;
			 window.onload=form_error(message);
			  function form_error(message){
				  if(message == "success")
					  swal("Congratulations !", "Registration completed successfully !", "success")
					else if(message == "failure")
					  swal("Sorry...", "Registration Failed !", "error")
			  }
			  
          </script>

</body>
