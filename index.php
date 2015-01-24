<?php
    ob_start();
	include_once("includes/application_top.php");
    $formObj->form();

	if(!isset($_SESSION['username'])&&!isset($_SESSION['userType'])&&!isset($_SESSION['userFName']))
	{
			$funObj->redirect("login.php");
	}
	
    $clickedPage=(isset($_GET['page']))?$_GET['page']:"index";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
    
    
    <link rel="shortcut icon" href="img/favicon.png">
 	-->
    
    </head>

    <body>
        
        <!--header div and navbar-->
        <?php
            include_once("includes/pages/header.php"); 
        ?>
        <!--header div and navbar closed-->
        
        <!--Body & body contents goes here-->
        <?php
            if($clickedPage=="attend/attend_process")
                require("modules/$clickedPage.php");
            else
            {
        ?>
        <div class="container-fluid">
            <div class="row-fluid" >
            <!--All the body contents goes inside this span div-->            
                <div class="span11">
                    <?php
                        if($clickedPage=="index")
                        {
                            include_once("includes/pages/container.php");
                        }
                        else
                        {
                            $redirectPage="modules/".$clickedPage.".php";
                            require($redirectPage);                  
                        }
                    ?>       
                </div>
            </div>
        </div>
        <?php } ?>

        <!--footer div and navbar-->
        <?php
            include_once("includes/pages/footer.php"); 
        ?>
        <!--footer div and navbar closed-->

        
        
        <!--Body & body contents closed-->

        <!-- Le javascript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
         
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/lightbox-2.6.min.js"></script>
        <script src="plugins/ckeditor/ckeditor.js"></script>

                 
    </body>
</html>
