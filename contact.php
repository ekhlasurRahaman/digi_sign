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
	
	 <!--for sweet alert message-->
	   <script src="includes/message_alert/sweetalert-dev.js"></script>
       <link rel="stylesheet" href="includes/message_alert/sweetalert.css">


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
		  

.wrapper {    
	margin-top: 20px;
	margin-bottom: 20px;
	float:left;
}

.contact_table{
	margin-left:8%;
}
 
  
  .custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
  .custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
	
.add_contact {
			width: 380px;
			margin-top:100px;
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
		$errors = errors();
		$message = message();
	?>
   <!--breadcrumbs start-->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
		  <?php 
				$public = $_SESSION["public"];
		        $name= $public["first_name"];
				$vein_data= $public["vein_data"];
			?>
            <h1 style="color:#F7FE2E;">
              <i class="glyphicon glyphicon-user"> </i>
			  <?php echo $name;?>
            </h1>
          </div>
          <div class="col-lg-8 col-sm-8">
            <ol class="breadcrumb pull-right">
			<a class="btn btn-info navbar-right" href="otk_form.php"> Back <i class="glyphicon glyphicon-triangle-left"></i></a>
                        
            </ol>
          </div>
        </div>
      </div>
    </div>



<div class="container">
    <div class="row col-md-10 col-md-offset-2 custyle contact_table">
    <table class="table table-striped custab">
    <thead>
    <a class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#add_contact"><b>+</b> Add new contact</a>
        <tr>
            <th>Name</th>
            <th>E-Mail</th>
			<th>Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
            <?php echo contact_table($vein_data);?>
    </table>
    </div>
</div>






    <div class="container">
          <div class="modal fade" id="add_contact" role="dialog">
              <div class="modal-dialog modal-sm add_contact">             
                 <div class="modal-content">
                      <div class="modal-header ">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">+ Add Contact </h4>
                       </div>
                       <div class="modal-body">
                          <form action="contact_process.php" method="post" >
								<input type="text" class="form-control" name="name" value="" placeholder="Name">
								<br>
								<input type="text" class="form-control" name="email" value="" placeholder="Email">
								<br>
								<button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Done</button>
								<button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>Reset</button>
                              </form>
							  
                      </div>
                  </div>

              </div>
          </div>
      </div>
	  
	  
	  
	  
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
			  var errors = "<?php echo $errors?>" ;
			 window.onload=form_error(message,errors);
			  function form_error(message=0, errors=0){
				  if(message == "success")
					  swal("Done !", "Contact is added successfully !", "success")
				  else if(message == "failure")
					  swal("Sorry...", "Some thing went wrong !", "error")
				  else if(errors == "errors")
					  swal("Sorry...", "Fill up the form with correct content !", "error")
				  else
				  return;
			  }
			  
			
          </script>
		  
		  <!-- for signature pad -->
		  <script type="text/javascript" src="sigPad/js/jquery-2.1.4.min.js"></script>
		  <script type="text/javascript" src="sigPad/js/flashcanvas.js"></script>
		  <script type="text/javascript" src="sigPad/js/json2.min.js"></script>
          <script type="text/javascript" src="sigPad/js/jquery.signaturepad.min.js"></script>
          <script type="text/javascript" src="sigPad/js/functions.js"></script>


</body>

