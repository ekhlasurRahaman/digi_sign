<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["public"])){
		redirect_to("index.php");
	}
?>
<?php require_once("includes/pdf2text.php"); ?>
<?php
// In an application, this could be moved to a config file
$upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
  UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_file_size.",
  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
  UPLOAD_ERR_PARTIAL 	=> "Partial upload.",
  UPLOAD_ERR_NO_FILE 	=> "No file.",
  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
);
?>
<?php
if(isset($_POST['submit'])) {
	// process the form data
	$tmp_file = $_FILES['file_upload']['tmp_name'];
	$target_file = basename($_FILES['file_upload']['name']);
	$upload_dir = "file_uploads";
	// You will probably want to first use file_exists() to make sure
	// there isn't already a file by the same name.
	
	// move_uploaded_file will return false if $tmp_file is not a valid upload file 
	// or if it cannot be moved for any other reason
	if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
		
		$userfile_extension = explode(".", strtolower($target_file));
		$extension = end($userfile_extension);
		$file =$target_file;
		$_SESSION["upload_file"]= $file;
		if($extension == 'pdf'){
			//$docObj = new Filetotext($file);
            $content =pdf2text($file);
			$_SESSION["content"]= $content;
			$_SESSION["file_upload"]=1;
			redirect_to("document_signing.php");
			//echo $content;
		}elseif($extension == 'txt'){
			if($handle = fopen($file, 'r')) {  // read
			  $content = fread($handle, filesize($file));
			  fclose($handle);
			  $_SESSION["file_upload"]=1;
			  $_SESSION["content"]= $content;
			 redirect_to("document_signing.php");
			 // echo $content;
			}
		}else{
			$_SESSION["file_upload"]=0;
		   $message = "Please Upload PDF or TXT File.";
		}
	} else {
		$error = $_FILES['file_upload']['error'];
		$message = $upload_errors[$error];
	}
	
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
              Database is busy now.Please Wait.
            </li>

            <li style="color:red;font-size: 20px;">
			<i class="glyphicon glyphicon-hand-right">
              </i>
              <?php
			  
			    if(!empty($message)){
			           echo $message;
					 }
			   ?>
             
            </li>
          </ul>
        </div>
      </div>
	  <div class="btn btn-lg" style="height:100px;" ></div>
	  
	  <a class="btn btn-lg btn-login btn-block" style="background-color:#48CFAD;" href="document_signing.php" ><i class="glyphicon glyphicon-ok">
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

