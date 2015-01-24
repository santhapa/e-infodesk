<?php
      include_once("includes/session.php");
      $formObj->form();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in e-InfoDesk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
    <!-- Fav and touch icons--> 
    
    <link rel="shortcut icon" href="img/favicon.png">
 
 	<!-- this page css-->
    <link rel="stylesheet" type="text/css" href="css/pages/login.css">

    </head>

    <body>
        <?php
            if($formObj->num_errors > 0 )
            {
                ?>
                <div class="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <center><strong><?php 
                                echo $formObj->error("reset");
                                echo $formObj->error("access");
                                echo $formObj->error("attempt");
                            ?>
                    </strong></center>
                </div>
                <?php
            }
        ?>

        <!-- begins container -->
        <div class="container">          
            <form class="form-reset-password" method="post" action="process.php">
               
                <h3 class="form-reset-heading" style=" text-align: center" >Please enter your Username and Email Address!</h3>
                        
                <input type="text" class="input-block-level" placeholder="Username" name="resetUsername" value="<?php echo $formObj->value("resetUsername"); ?>">
                <input type="text" class="input-block-level" placeholder="Email Address" name="resetEmailId" value="<?php echo $formObj->value("resetEmailId"); ?>">
                <input type="hidden" name="getPassword" value="1">
                <button class="btn btn-large btn-block btn-primary" type="submit" name="submit">Submit</button>
            </form>
        </div>
        <!-- end container -->
        
        <!-- Le javascript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>



