<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
      eDigiSigner | Contact
    </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/flexslider.css"/>
    <link href="assets/bxslider/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>


    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
	
	<!--for sweet alert message-->
	   <script src="includes/message_alert/sweetalert-dev.js"></script>
       <link rel="stylesheet" href="includes/message_alert/sweetalert.css">
<style>
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
<script src="js/html5shiv.js">
</script>
<script src="js/respond.min.js">
</script>
<![endif]-->
  </head>
  <?php 
      	//Insert errors into variables($errors) from session.
      	$errors = errors();
		$message = message()
      ?>

  <body>
    <!--header start-->
    <header class="head-section">
      <div class="navbar navbar-default navbar-static-top container">
          <div class="navbar-header">
              <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse"
              type="button"><span class="icon-bar"></span> <span class="icon-bar"></span>
              <span class="icon-bar"></span></button> <a class="navbar-brand" href="index.html">eDigi
              <span>Signer</a>
          </div>

      </div>
    </header>
    <!--header end-->

    <!--breadcrumbs start-->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <h1 style="color:yellow;">
              <i class="glyphicon glyphicon-question-sign"> </i>
			  Contacts
            </h1>
          </div>
          <div class="col-lg-8 col-sm-8">
            <ol class="breadcrumb pull-right">
			<a class="btn btn-info navbar-right" href="index.php"><i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                        
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!--breadcrumbs end-->



    <!--container start-->
    <div class="container">


      <div class="row">
        <div class="col-lg-5 col-sm-5 address">
          <section class="contact-infos">
            <h4 class="title custom-font text-black">
             <i class="glyphicon glyphicon-book" style="color:rgba(81, 203, 238, 1);">
              </i>  ADDRESS
            </h4>
            <address>
			  Shukrabad
			  <br>
              102 Mirpur Road
              <br>
              Dhaka 1207, Bangladesh
            </address>
          </section>
          <section class="contact-infos">
            <h4 class="title custom-font text-black">
              <i class="glyphicon glyphicon-info-sign" style="color:rgba(81, 203, 238, 1);">
              </i> Help & Support
            </h4>
            <p>
              How to drow your Signature ?
              <br>
              How to Sign your Document ?
              <br>
              How to Verify your Document ?
              <br>
            </p>
          </section>
          <section class="contact-infos">
            <h4>
              <i class="glyphicon glyphicon-phone-alt" style="color:rgba(81, 203, 238, 1);">
              </i> Contacts  
            </h4>
			<p>
              Questions or Problems? Call Now
            </p>
            <p>
              <i class="glyphicon glyphicon-phone">
              </i>
              +880-1787987929
            </p>
			<p>
              <i class="glyphicon glyphicon-phone">
              </i>
			  +880-1711705012
            </p>
            <p>
              <i class="glyphicon glyphicon-envelope">
              </i> edigisignservice@gmail.com
            </p>

          </section>
        </div>
        <div class="col-lg-7 col-sm-7 address">
          <h4>
            Drop us a line so that we can hear from you
          </h4>
          <div class="contact-form">
            <form role="form" action="public_contacts_process.php" method="POST">
              <div class="form-group">
                <label for="name">
                  Name
                </label>
                <input type="text" placeholder="" id="name" name="name" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">
                  Email
                </label>
                <input type="text" placeholder="" id="email" name="email" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">
                  Phone
                </label>
                <input type="text" id="phone" value="" name="phone" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">
                  Message
                </label>
                <textarea placeholder="" rows="5" value="" name="message" class="form-control">
                </textarea>
              </div>
              <button class="btn btn-info" type="submit" name="submit" value="Submit">
                Submit
              </button>
            </form>

          </div>
        </div>
      </div>

    </div>
    <!--container end-->
    <div class="container">
      <div class="row">
        <div class='col-md-offset-2 col-md-8 text-center'>
          <h2>
            Administrator eDigiSigner
          </h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-offset-2 col-md-8 mar-b-30">
          <div class="carousel slide" data-ride="carousel" id="quote-carousel">
            <!-- Bottom Carousel Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#quote-carousel" data-slide-to="0" class="active">
              </li>
              <li data-target="#quote-carousel" data-slide-to="1">
              </li>
              <li data-target="#quote-carousel" data-slide-to="2">
              </li>
            </ol>

            <!-- Carousel Slides / Quotes -->
            <div class="carousel-inner">

              <!-- Quote 1 -->
              <div class="item active">
                <blockquote>
                  <div class="row">
                    <div class="col-sm-3 text-center">
                      <img class="img-circle" src="img/narayan_sir.jpg" style="width: 100px;height:100px;" alt="">
                    </div>
                    <div class="col-sm-9">
                      <p>
                       Mr. Narayan Ranjan Chakraborty
                      </p>
                      <small>
                        Senior Lecturer DIU
                      </small>
                    </div>
                  </div>
                </blockquote>
              </div>
              <!-- Quote 2 -->
              <div class="item">
                <blockquote>
                  <div class="row">
                    <div class="col-sm-3 text-center">
                      <img class="img-circle" src="img/ekhlasur.jpg" style="width: 100px;height:100px;" alt="">
                    </div>
                    <div class="col-sm-9">
                      <p>
                        Md.Ekhlasur Rahman
                      </p>
                      <small>
                        Student DIU
                      </small>
                    </div>
                  </div>
                </blockquote>
              </div>
              <!-- Quote 3 -->
              <div class="item">
                <blockquote>
                  <div class="row">
                    <div class="col-sm-3 text-center">
                      <img class="img-circle" src="img/taifur.jpg" style="width: 100px;height:100px;" alt="">
                    </div>
                    <div class="col-sm-9">
                      <p>
                        Md.Taifur Rahman
                      </p>
                      <small>
                        Student DIU
                      </small>
                    </div>
                  </div>
                </blockquote>
              </div>
            </div>


          </div>

        </div>
      </div>
    </div>

    <!--footer start-->
    <!--small footer end-->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="js/hover-dropdown.js">
    </script>
    <script type="text/javascript" src="assets/bxslider/jquery.bxslider.js">
    </script>


    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&AMP;sensor=false">
    </script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js">
    </script>
    <script src="js/wow.min.js">
    </script>
    <script>
      wow = new WOW(
        {
          boxClass:     'wow',      // default
          animateClass: 'animated', // default
          offset:       0          // default
        }
      )
        wow.init();
    </script>


    <script>
    
      
           var message = "<?php echo $message?>" ;
		   var errors = "<?php echo $errors?>" ;
			 window.onload=form_error(message,errors);
			  function form_error(message=0, errors=0){
				  if(message == "success")
					  swal("Thank You !", "For Stay with us !", "success")
				  else if(message == "failure")
					  swal("Sorry...", "Some thing went wrong !", "error")
				  else if(errors == "errors")
					  swal("Sorry...", "Fill up the form with correct content !", "error")
				  else
				  return;
			  }


    </script>

  </body>
</html>
