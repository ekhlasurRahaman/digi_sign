<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
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
	
	<!-- for File Upload -->
    
	 <link href="file_uploads/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
	 
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
		  .modal-dialog-otk {
			width: 350px;
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
		  
		iframe {
			width: 1100px;
			height: 700px;
			margin-top:40px;
			margin-left: 120px;
			
	     	-moz-border-radius: 12px;
			-webkit-border-radius: 12px;
			border-radius: 12px;

			-moz-box-shadow: 4px 4px 14px #000;
			-webkit-box-shadow: 4px 4px 14px #000;
			box-shadow: 4px 4px 14px #000;
			filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=.2);
		}
	#background {
            width: 900px;
			height: 400px;
			margin-top:20px;
			margin-left: 220px;
			
	     	-moz-border-radius: 12px;
			-webkit-border-radius: 12px;
			border-radius: 12px;

			-moz-box-shadow: 4px 4px 14px #000;
			-webkit-box-shadow: 4px 4px 14px #000;
			box-shadow: 4px 4px 14px #000;
			filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=.2);
  }
		
      </style>



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->


  
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
				$file_upload = $_SESSION["file_upload"];
		        $client_name = $public["first_name"];
				$client_vein = $public["vein_data"];
				$signature = find_client_signature($client_vein);
				
				?>
                    <h1 style="color:#F5DA81;">Hi!  <?php echo $client_name;?></h1>
                </div>
                <div class="col-lg-8 col-sm-8">
				   <ol class="nav navbar-nav navbar-right">
				   <a style ="color: white;" href="logout.php">Logout <i class="glyphicon glyphicon-off" style ="color: red;"></i></a>
                    </ol>	
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
    <a class="btn btn-primary navbar-left" style="margin-left:310px;" data-toggle="modal" data-target="#upload_file"><i class="glyphicon glyphicon-cloud-upload"></i>     Upload File </a>

	<?php

        echo "<button class=\"btn btn-primary navbar-left\" style=\"margin-left:25px;\" onclick = \"sign_document($signature, $file_upload)\"><i class=\"glyphicon glyphicon-pencil\"></i>     Sign Document </button>";

    ?>
	
	<a class="btn btn-primary navbar-left" style="margin-left:25px;" href="signature_pad/signature_pad.php"><i class="glyphicon glyphicon-edit"></i>     Draw Signature </a>
	
	<?php

        echo "<button class=\"btn btn-primary navbar-left\" style=\"margin-left:25px;\" onclick =\"get_signature($signature)\"><i class=\"glyphicon glyphicon-check\"></i>     View Signature </button>";

    ?>
	
	<a class="btn btn-primary navbar-left" style="margin-left:25px;" data-toggle="modal" data-target="#file_verification"><i class="glyphicon glyphicon-saved"></i>     Verification </a>
    <!--container start-->
	<!--
	<p  style=" margin: 12px auto 6px auto; font-family: Helvetica,Arial,Sans-serif; font-style: normal; font-variant: normal; font-weight: normal; font-size: 14px; line-height: normal; font-size-adjust: none; font-stretch: normal; -x-system-font: none; display: block;">   <a title="View Rdbms SQL Query(Sajol) on Scribd" href="https://www.scribd.com/doc/286120021/Rdbms-SQL-Query-Sajol"  style="text-decoration: underline;" >Rdbms SQL Query(Sajol)</a></p><iframe class="scribd_iframe_embed" src="https://www.scribd.com/embeds/286120021/content?start_page=1&view_mode=scroll&show_recommendations=true" data-auto-height="false" data-aspect-ratio="undefined" scrolling="no" id="doc_96852" width="100%" height="600" frameborder="0"></iframe>
	-->
	<?php 
		
		if($file_upload !== 0){
			$file_name = $_SESSION["upload_file"];
			echo "<iframe src=$file_name></iframe>";
		}else{
			echo "<video autoplay loop muted poster=\"video/Capture.JPG\" id=\"background\">\n";
            echo "        <source src=\"video/What is a Digital Signature.mp4\" type=\"video/mp4\">\n";
            echo "    </video>";

		}
	
	?>
	
	<div class="file-footer-caption"><?php if($file_upload !== 0){echo $file_name;}?></div>


    <!--container end-->
	<!--popup window for public sign up start-->
      <!-- Modal file Upload-->
      <div class="container">
          <div class="modal fade" id="upload_file" role="dialog">
              <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header ">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Let's get Started</h4>
                       </div>
                       <div class="modal-body">
                          <form action="file_upload.php" enctype="multipart/form-data" method="post" >
								<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
								<input id="file-0a" class="file" type="file" name="file_upload" multiple data-min-file-count="1">
								<br>
								
								<input type="submit" class="btn btn-primary" name="submit" value="Upload" />
								<button type="reset" class="btn btn-default">Reset</button>
                              </form>
							  
                      </div>
                  </div>

              </div>
          </div>
      </div>
          <!--popup window for file upload end-->
		  
		  
		  
		  <!--popup window for file_verification end -->

	<div class="container">
          <div class="modal fade" id="file_verification" role="dialog">
              <div class="modal-dialog modal-sm modal-dialog-otk">
				
                  
                  <div class="modal-content">
                      <div class="modal-header ">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Verify Your File </h4>
                       </div>
                       <div class="modal-body">
                          <form action="verification.php" method="post" >
								<input type="text" class="form-control" name="receiver_otk" value="" placeholder="Please Submit Authentication Code">
								<br>
								<input type="text" class="form-control" name="public_key" value="" placeholder="Submit Public Key">
								<br>
								<button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Done</button>
								<button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>Reset</button>
                              </form>
							  
                      </div>
                  </div>

              </div>
          </div>
      </div>
		  <!-- popup window for OTK end-->
		  
		  
          <!--footer start 
          <footer class="footer">
          </footer>-->
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
		  
				function get_signature(signature){
					if(signature==1)
						document.location.href = 'signature_pad/show_signature.php'
					else
						
						swal("Sorry...", "Draw Your Signature First !", "error")
				};

				
				function sign_document(signature, file_upload){
					if(signature == 1 && file_upload == 1)
						document.location.href = 'email/sendmail.php'					
					else if(signature == 0 && file_upload == 1)
					  swal("Sorry...", "Draw Your Signature First !", "error")
					else if(signature == 1 && file_upload == 0)
					  swal("Sorry...", "Upload Your File First !", "error")
					else
						swal("Sorry...", "Draw Your Signature & Upload Your File.", "error")
						
				};

				
		  
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
		  
		  <!-- for File Upload -->
		  
		  
		  <script src="file_uploads/js/fileinput.js" type="text/javascript"></script>
          <script src="file_uploads/js/fileinput_locale_el.js" type="text/javascript"></script>
          <script src="file_uploads/js/fileinput_locale_es.js" type="text/javascript"></script>



