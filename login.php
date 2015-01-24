<?php
      include_once("includes/application_top.php");
      $formObj->form();

        if(isset($_SESSION['username']))
        {
            $funObj->redirect("index.php");
        }
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
    
    
    <link rel="shortcut icon" href="img/favicon.png">
 
 	<!-- this page css-->
    <link rel="stylesheet" type="text/css" href="css/pages/login.css">

    </head>

    <body>

        <?php 
            if($formObj->num_errors > 0)
            {
                ?>
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <center><strong><?php 
                                echo $formObj->error("access");
                                echo $formObj->error("attempt");
                            ?>
                    </strong></center>
                </div>
                <?php
            }
            if($formObj->num_success >0)
            {
                ?>
                <div class="alert alert-success" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <center><strong><?php 
                                echo $formObj->success("reset");
                                ?>
                    </strong></center>
                </div>
                <?php
            }
        ?>
        <!-- begins container -->
        <div class="container">          
            <form class="form-signin" method="post" action="process.php">
               
                <h3 class="form-signin-heading" style=" text-align: center" >e-InfoDesk</h3>
                <?php $userType=$formObj->value("userType"); ?>
                <select id="userTypeSel" class="input-block-level" name="userType">
                    <option selected disabled style="color: #999">Select User Type</option>
		    		<option value="1" <?php echo ($userType==1) ?' selected="selected"':''; ?>>Admin</option>
                    <option value="2" <?php echo ($userType==2) ?' selected="selected"':''; ?>>Student</option>
		      		<option value="3" <?php echo ($userType==3) ?' selected="selected"':''; ?>>Staff</option>
                </select>        
                        
                <input type="text" required class="input-block-level" placeholder="Username" id="userBox" name="username" value="<?php echo $formObj->value("username"); ?>">
                <input type="password" required class="input-block-level" placeholder="Password" id="pswdBox" name="password" value="">
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
                <center><a href="forget_password.php" class="forget-password" name="forget">Forget Password?</a></center>
                <br>
                <input type="hidden" name="loginProcess" value="1">
                <button class="btn btn-large btn-block btn-primary" type="submit" name="signIn">Sign in</button>
            </form>
        </div>
        <!-- end container -->
        
        <!-- Le javascript================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>

        <!-- Jquery for select option-->
        <script type="text/javascript">

          $(document).ready(function(){
    
             $("#userTypeSel").change(function() {
    
                if (($("#userTypeSel").val() == 1) || ($("#userTypeSel").val() == 2) || ($("#userTypeSel").val() == 3))
                {
                    $("#userBox").show();
                    $("#pswdBox").show();
                }
                                        
                else
                {                    
                    $("#userBox").hide();
                    $("#pswdBox").hide();
                }
    
             });
    
            $("#userTypeSel").change();
    
          });
        </script>
    </body>
</html>



