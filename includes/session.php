<?php
include_once("function.php");
include_once("form.php");

   class Session
   {
      var $username;            //Username given on sign-up
      var $time;                //Time user was last active (page loaded)
      var $logged_in;           //True if user is logged in, false otherwise
      var $userinfo = array();  //The array holding all user info
      var $ip;                  //Remote IP address  


      function Session()
      {
         $this->ip = $_SERVER["REMOTE_ADDR"];
         $this->time = time();
         $this->startSession();
      }

      function startSession()
      {
         session_start();   
   
         /* Determine if user is logged in */
         $this->logged_in = $this->checkLogin();
      }

      function checkLogin()
      {
         global $funObj; 
         
         /* Check if user has been remembered */
         if(isset($_COOKIE['cookname']))
         {
            $this->username = $_SESSION['username'] = $_COOKIE['cookname'];
         }

         if(isset($_SESSION['username']) && $_SESSION['userType'])
         {  
                        
            return true;
         }
         
         else
         {
            return false;
         }
      }

      function login($user, $username, $password, $remember)
      {
         global $funObj, $formObj;  

         /* Checks if this IP address is currently blocked*/ 
         $result = $funObj->confirmIPAddress($this->ip);

         if($result == 1)
         {
            $error_type = "access";
            $formObj->setError($error_type, "Access denied for ".timePeriod." minutes");
         } 

         /* Return if form errors exist */
         if($formObj->num_errors > 0)
         {  
            return false;
         }
     
         $error_type = "attempt";
         /* Username and password error checking */
         if(!$username || !$password || strlen($username = trim($username)) == 0)
         {
            $formObj->setError($error_type, "Username or Password not entered");
         }
      
         if($formObj->num_errors > 0)
         {
            return false;
         }

         /* Checks that username is in database and password is correct */
         $result = $funObj->confirmUserPass($user, $username, $password);

         if($result == 1)
         {
            $formObj->setError($error_type, "Invalid username or password.");
            $funObj->addLoginAttempt($this->ip);
         }
     
         if($formObj->num_errors > 0)
         {
            return false;
         }

         /* Username and password correct, register session variables */
         $this->userinfo  = $funObj->getUserInfo($user, $username, $password);
         $this->username  = $_SESSION['username'];

      
         /* Null login attempts */
         $funObj->clearLoginAttempts($this->ip);

         if($remember)
         {
            setcookie("cookname", $this->username, time()+COOKIE_EXPIRE, COOKIE_PATH);
         }

         /* Login completed successfully */
         return true;
      }

      function logout()
      {
         global $funObj;  

         if(isset($_COOKIE['cookname']))
         {
            setcookie("cookname", "", time()-COOKIE_EXPIRE, COOKIE_PATH);
         }

         unset($_SESSION['userFName']);
         unset($_SESSION['userType']);
         unset($_SESSION['username']);
         
         $this->logged_in = false;
      
      }

      function passwordRecovery($username, $email)
      {
         global $funObj, $formObj;
         $error_type="reset";
         /* Username and Email Address error checking - filled or not*/
         if(!$username || !$email || strlen($username = trim($username)) == 0 || strlen($email = trim($email)) == 0)
         {
            $formObj->setError($error_type, "Username or Email Address not entered.");
         }  

         if($formObj->num_errors > 0)
         {
            return false;
         }

         /* check email validity with corresponding email*/
         $result=$funObj->checkEmail($username, $email);

         if($result==1)
         {
            $formObj->setError($error_type, "The submitted username or email address did not match to those on database.");
         }

         if($formObj->num_errors > 0)
         {
            return false;
         }

         /*get a new password for corresponding user*/
         $email_body="Your password to ".siteName." has been temporarily changed. Your new password is '$result' Please login to continue. ".siteName." and you can change the password that is more familiar to you. Thank you!";
         $subject="Password Changed!";
         /*send email*/
         $funObj->mailerPhpStart($email, $subject, $email_body, $username);
         
         $success_type="reset";
         $formObj->setSuccessMsg($success_type, "The new temporary password has been sent to your email. Please check your email to continue.");

         return true;
      }
   };


   /* Initialize session object */
   $sessObj = new Session;
  

?>
