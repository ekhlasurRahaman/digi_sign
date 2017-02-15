<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php 
	if(!isset($_SESSION["public"])){
		redirect_to("index.php");
	}
?>
<?php
echo "<!DOCTYPE html>\n";
echo "<html lang=\"en\">\n";
echo "  <head>\n";
echo "    <meta charset=\"utf-8\">\n";
echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
echo "    <meta name=\"description\" content=\"Developed By M Abdur Rokib Promy\">\n";
echo "    <meta name=\"author\" content=\"cosmic\">\n";
echo "    <meta name=\"keywords\" content=\"Bootstrap 3, Template, Theme, Responsive, Corporate, Business\">\n";
echo "    <link rel=\"shortcut icon\" href=\"img/favicon.png\">\n";
echo "\n";
echo "    <title>eDigiSigner | Home</title>\n";
echo "\n";
echo "    <!-- Bootstrap core CSS -->\n";
echo "    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n";
echo "    <link href=\"css/theme.css\" rel=\"stylesheet\">\n";
echo "    <link href=\"css/bootstrap-reset.css\" rel=\"stylesheet\">\n";
echo "    <!--external css-->\n";
echo "    <link href=\"assets/font-awesome/css/font-awesome.css\" rel=\"stylesheet\" />\n";
echo "    <link rel=\"stylesheet\" href=\"css/flexslider.css\"/>\n";
echo "    <link href=\"assets/bxslider/jquery.bxslider.css\" rel=\"stylesheet\" />\n";
echo "    <link rel=\"stylesheet\" href=\"css/animate.css\">\n";
echo "    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>\n";
echo "\n";
echo "\n";
echo "      <!-- Custom styles for this template -->\n";
echo "    <link href=\"css/style.css\" rel=\"stylesheet\">\n";
echo "    <link href=\"css/style-responsive.css\" rel=\"stylesheet\" />\n";
echo "\n";
echo "    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->\n";
echo "    <!--[if lt IE 9]>\n";
echo "      <script src=\"js/html5shiv.js\"></script>\n";
echo "      <script src=\"js/respond.min.js\"></script>\n";
echo "    <![endif]-->\n";
echo "  </head>\n";
echo "\n";
echo "  <body>\n";
echo "\n";
echo "    <!--breadcrumbs start-->\n";
echo "    <div class=\"breadcrumbs\">\n";
echo "        <div class=\"container\">\n";
echo "            <div class=\"row\">\n";
echo "                <div class=\"col-lg-4 col-sm-4\">\n";
echo "                    <a class=\"navbar-brand\" href=\"index.php\"><li class=\"glyphicon glyphicon-home\"></li> eDigi<span>Signer</span></a>\n";
echo "                </div>\n";
echo "                <div class=\"col-lg-8 col-sm-8\">\n";
echo "                    <ol class=\"breadcrumb pull-right\">\n";
echo "                        \n";
echo "                    </ol>\n";
echo "                </div>\n";
echo "            </div>\n";
echo "        </div>\n";
echo "    </div>\n";
echo "    <!--breadcrumbs end-->\n";
echo "\n";
echo "    <!--container start-->\n";
echo "    <div class=\"gray-bg\">\n";
echo "    <div class=\"fof\">\n";
echo "        <div class=\"container  error-inner wow flipInX\">\n";
echo "            <h1 style=\"color:#37BC9B\"><li class=\"glyphicon glyphicon-cloud-download\"></li> Your signed document is now downloading  . . .</h1>\n";
echo "            <h4 class=\"text-center\">Don't close the window until download is starting.</h4>\n";
					echo nl2br("\n ");
echo "            <a class=\"btn btn-primary\" style=\"width:150px\" href=\"document_signing.php\"><li class=\"glyphicon glyphicon-dashboard\"></li>  GO BACK </a>\n";
echo "        </div>\n";
echo "        <!-- /404 error -->\n";
echo "        </div>\n";
echo "    </div>\n";
echo "    <!--container end-->\n";
echo "\n";
echo "    \n";
echo "  <!-- js placed at the end of the document so the pages load faster -->\n";
echo "    <script src=\"js/jquery.js\"></script>\n";
echo "    <script src=\"js/bootstrap.min.js\"></script>\n";
echo "    <script type=\"text/javascript\" src=\"js/hover-dropdown.js\"></script>\n";
echo "    <script defer src=\"js/jquery.flexslider.js\"></script>\n";
echo "    <script type=\"text/javascript\" src=\"assets/bxslider/jquery.bxslider.js\"></script>\n";
echo "\n";
echo "    <script src=\"js/jquery.easing.min.js\"></script>\n";
echo "    <script src=\"js/link-hover.js\"></script>\n";
echo "\n";
echo "\n";
echo "     <!--common script for all pages-->\n";
echo "    <script src=\"js/common-scripts.js\"></script>\n";
echo "\n";
echo "\n";
echo "    <script src=\"js/wow.min.js\"></script>\n";
echo "    <script>\n";
echo "        wow = new WOW(\n";
echo "          {\n";
echo "            boxClass:     'wow',      // default\n";
echo "            animateClass: 'animated', // default\n";
echo "            offset:       0          // default\n";
echo "          }\n";
echo "        )\n";
echo "        wow.init();\n";
echo "    </script>\n";
echo "\n";
echo "  </body>\n";
echo "</html>\n";

?>
<script>
   window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "signature_pad/signature.php";

    }, 5000);
</script>