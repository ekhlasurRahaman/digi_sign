<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	if(!isset($_SESSION["public"])){
		redirect_to("index.php");
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

      <style>

          .modal-footer {
              background-color: #f9f9f9;
          }
     	  .clearButton{
			
			display:block;
		  }
		 .sButton{
			
			width:167px;
		  }
		  
		  .otk {
			width: 300px;
			padding-top: 30px;
			padding-bottom:30px;
			padding-left:50%;
			margin-left: 8%;
		  }
		  .vertical-line{
			  width: 1px;
			  background-color: silver;
			  height: 100%;
			  float: left;
			  margin-left: 50%;
			  border: 2px ridge silver ;
			  border-radius: 2px;
			}
			
			
			
			
			
			
.wrapper {    
	margin-top: 20px;
	margin-bottom: 20px;
}

.form-signin {
  max-width: 420px;
  padding: 30px 38px 66px;
  margin: 0 auto;
  background-color: #eee;
  border: 3px dotted rgba(0,0,0,0.1);  
  }

.form-signin-heading {
  text-align:center;
  margin-bottom: 30px;
}

.form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
}

input[type="text"] {
  margin-bottom: 0px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

input[type="email"] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.colorgraph {
  height: 7px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}

	#background {
            width: 800px;
			height: 370px;
			margin-top:px;
			margin-left: 260px;
			
	     	-moz-border-radius: 12px;
			-webkit-border-radius: 12px;
			border-radius: 12px;

			-moz-box-shadow: 4px 4px 14px #000;
			-webkit-box-shadow: 4px 4px 14px #000;
			box-shadow: 4px 4px 14px #000;
			filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=.2);
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

   <!--breadcrumbs start-->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
		  <?php 
				$public = $_SESSION["public"];
		        $name= $public["first_name"];
			?>
            <h1 style="color:#F7FE2E;">
              <i class="glyphicon glyphicon-user"> </i>
			  <?php echo $name;?>
            </h1>
          </div>
          <div class="col-lg-8 col-sm-8">
            <ol class="breadcrumb pull-right">
			<a class="btn btn-info navbar-right" href="document_signing.php"> Back <i class="glyphicon glyphicon-triangle-left"></i></a>
                        
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!--breadcrumbs end-->
	
	<!--container start-->
	
	
		<?php
			$otk_form_active = 1;//$_SESSION["active_otk_form"];	
			if($otk_form_active==1){
				echo "<div class = \"container\">\n";
				echo "	 <div class=\"wrapper\">\n";
				echo "	<center><a class=\"btn btn-primary\" style=\"width:420px; height:30px; background-color:#797979;\" href=\"contact.php\"><i class=\"glyphicon glyphicon-phone-alt\"></i>  Contact</a>\n </center>";
				echo "		<form action=\"otk_process.php\" method=\"post\" name=\"Login_Form\" class=\"form-signin\">       \n";
				echo "		    <h3 class=\"form-signin-heading\">Authentication Required</h3>\n";
				echo "			  <hr class=\"colorgraph\"><br>\n";
				echo "			  \n";
				echo "			  <input type=\"text\" class=\"form-control\" name=\"sender_otk\" value=\"\" placeholder=\"Please Submit Authentication Code\">\n";
				echo "			  <input type=\"text\" class=\"form-control\" name=\"receiver_email\" value=\"\" placeholder=\"Submit Receiver E-Mail\">    \n";
				echo "			  <button type=\"submit\" class=\"btn btn-primary sButton\" name=\"submit\"><i class=\"glyphicon glyphicon-pencil\"></i>  Sign</button>\n";
				echo "			  <button type=\"reset\" class=\"btn btn-danger sButton\"><i class=\"glyphicon glyphicon-remove\"></i>Reset</button>\n";
				echo "			 \n";
				echo "			  \n";
				echo "		</form>			\n";
				echo "	 </div>\n";
				echo "   </div>";
			}else{
				echo "<img src=\"img/thank-you.png\" id=\"background\" alt=\"Thank You\">";
			}

		?>
	
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




