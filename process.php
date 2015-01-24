<?php
	include("includes/session.php");

	class Process
	{
   		function Process()
   		{
      		global $sessObj, $funObj;

      		if(isset($_POST['loginProcess']))
      		{
         		$this->procLogin();
      		}
      		
      		else if($sessObj->logged_in)
      		{
         		$this->procLogout();
      		}

          elseif ($_POST['getPassword']) 
          {
            $this->procRecovery();
          }

      		else
      		{
          		$funObj->redirect("index.php");
       		}
   		}


   		function procLogin()
   		{
      		global $sessObj, $formObj, $funObj;
      		
      		$user=mysql_real_escape_string($_POST['userType']);
        	$username=mysql_real_escape_string($_POST['username']);
        	$password=mysql_real_escape_string(md5($_POST['password']));
        	$remember=isset($_POST['remember']);
      		
      		/* Login attempt */
      		$retval = $sessObj->login($user, $username, $password, $remember);
                
      		/* Login successful */
      		if($retval)
      		{
            $funObj->loginHistory($user, $username, $password, $sessObj->ip);
            $funObj->redirect("index.php");
      		}
     
     		/* Login failed */
      		else
      		{            
            $_SESSION['value_array'] = $_POST;
         		$_SESSION['error_array'] = $formObj->getErrorArray();
           
         		$funObj->redirect("login.php"); 
      		}
   		}
   
   		function procLogout()
   		{
      		global $sessObj, $funObj;

      		$retval = $sessObj->logout();
      		$funObj->redirect("index.php");
   		}

      function procRecovery()
      {
        global $funObj, $sessObj, $formObj;

        $username=mysql_real_escape_string($_POST['resetUsername']);
        $email=mysql_real_escape_string($_POST['resetEmailId']);

        $retval=$sessObj->passwordRecovery($username, $email);

        /* Redirect to login page and show success message*/
        if($retval)
        {
          $_SESSION['success_array']= $formObj->getSuccessArray();
          $funObj->redirect("login.php");
        }

        else
        {
            
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $formObj->getErrorArray();
            
            $funObj->redirect("forget_password.php");
        } 


      }

};

$procObj= new Process;

?>
