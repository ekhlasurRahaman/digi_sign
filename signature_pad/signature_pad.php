<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["public"])){
		redirect_to("../index.php");
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/theme.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/flexslider.css"/>
    <link href="../assets/bxslider/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/animate.css">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>


    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />
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

  <body>
  
   <!--header start-->
    <header class="head-section">
      <div class="navbar navbar-default navbar-static-top container">
          <div class="navbar-header">
              <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="../index.php">eDigi<span>Signer</span></a>
          </div>
    </header>
    <!--header end-->

  
    
    <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
				<?php 
				$public = $_SESSION["public"];
		        $name= $public["first_name"];
				?>
                    <h1 style="color:#F5DA81;"><?php echo $name;?></h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
					<a class="btn btn-info navbar-right" href="../document_signing.php"> Back <i class="glyphicon glyphicon-triangle-left"></i></a>
                        
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
	
	<?php 
      	//Insert errors into variables($errors) from session.
		$message = message()
      ?>

    <!--container start-->
    <div class="registration-bg">
        <div class="container">

        <h1 style="text-align:center;">Drow your Signature For Signing Document</h1>
	
		<div class="form-signin wow fadeInUp">
		<h5 style="color:#F5DA81;text-align:center;"> <?php echo $message;?></h5>
		<h2 class="form-signin-heading">Create Your Own Signature</h2>
		
		<form method="post" action="capture_signature.php" class="sigPad">
		  
		  <div class="sig sigWrapper">
			<canvas class="pad" width="275" height="70"></canvas>
			<input type="hidden" name="output" class="output">
		  </div>
		  <div id="submit">
			<input class="btn btn-success" type="submit" name="submit" value="Submit Signature">
		  </div>
		  <div id="clear">
		   <button name="clear" type="clear" class="btn btn-danger clearButton">Clear Signature</button>	
		  </div>
		  <div style="clear:both;"></div>
		  
		  <div class="bottom"></div>
		  <div></div>
		</form>
		
	</div>

        </div>
     </div>
    <!--container end-->

          <!--footer start-->
          <footer class="footer">
          </footer>
          <!--small footer end-->
          <!-- js placed at the end of the document so the pages load faster -->
          <script src="../js/jquery-1.8.3.min.js"></script>
          <script src="../js/jquery.js"></script>
          <script src="../js/bootstrap.min.js"></script>
          <script type="../text/javascript" src="js/hover-dropdown.js"></script>
          <script defer src="../js/jquery.flexslider.js"></script>
          <script type="text/javascript" src="../assets/bxslider/jquery.bxslider.js"></script>

          <script src="../js/jquery.easing.min.js"></script>
          <script src="../js/link-hover.js"></script>


          <!--common script for all pages-->
          <script src="../js/common-scripts.js"></script>
          <script src="../js/wow.min.js"></script>
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


</body>
