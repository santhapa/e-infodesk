<?php
	
	include_once("database.php");
	include("./plugins/php_mailer/class.phpmailer.php");

	
	class Functions extends Database
	{
				
		function redirect($pageName)
		{
			header("location:$pageName");
		}

		function confirmIPAddress($value) 
		{
			$sql = "SELECT attemptcol_attempts,
						(CASE when 
							attemptcol_lastLogin is not NULL and 
							DATE_ADD(attemptcol_lastLogin, INTERVAL ".timePeriod." MINUTE)>NOW() then 1 else 0 end) as Denied
					FROM ".tableLoginAttempt." WHERE attemptcol_ipAddress = '$value'";

  			$res=$this->execute($sql);
   			$data = $this->fetchArray($res);   
   			//Verify that at least one login attempt is in database
		   	if (!$data) 
			{
     			return 0;
   			}

		   	if ($data['attemptcol_attempts'] >= attemptsNumber)
		   	{
      			if($data["Denied"] == 1)
      			{	
         			return 1;
      			}
     			
     			else
     			{
        			$this->clearLoginAttempts($value);
        			return 0;
    			}
   			}

   			return 0;  
  		}

  		function addLoginAttempt($value) 
  		{
   			// increase number of attempts
   			// set last login attempt time if required    
	  		$sql = "SELECT * FROM ".tableLoginAttempt." WHERE attemptcol_ipAddress = '$value'"; 
	  		$res =$this->execute($sql);
	  		$data = $this->fetchArray($res);
	  
	  		if($data)
      		{
      	  		$attempts = $data["attemptcol_attempts"]+1;

        		if($attempts==5) 
        		{
		 			$query = "UPDATE ".tableLoginAttempt." SET attemptcol_attempts=".$attempts.", attemptcol_lastLogin=NOW() WHERE attemptcol_ipAddress = '$value'";
		 			$result = $this->execute($query);
				}
        		else 
        		{
		 			$query = "UPDATE ".tableLoginAttempt." SET attemptcol_attempts=".$attempts." WHERE attemptcol_ipAddress = '$value'";
		 			$result = $this->execute($query);
				}
       		}

      		else 
      		{
	   			$query = "INSERT INTO ".tableLoginAttempt." (attemptcol_attempts,attemptcol_ipAddress,attemptcol_lastLogin) values (1, '$value', NOW())";
	   			$result = $this->execute($query);
	 		}
    	}

  		
  		function clearLoginAttempts($value) 
  		{
    		$sql = "UPDATE ".tableLoginAttempt." SET attemptcol_attempts = 0 WHERE attemptcol_ipAddress = '$value'"; 
			return $this->execute($sql);
   		}

   		function confirmUserPass($user, $username, $password)
		{
			
			if($user==1)
			{
				$sql="Select * from ".tableAdmin." where (admin_username='$username' and admin_password='$password')";
			}

			if($user==2 || $user==3)
			{
				$sql="Select * from ".tableUser." where (ucol_username='$username' and ucol_password='$password')";				
			}

			$res=$this->execute($sql);
			$count=$this->totalRows($res);

			if(!$res || $count < 1)
			{
				return 1; //Indicates username failure
			}

			else
			{
				$row=$this->fetchArray($res);
				
				switch ($user) 
				{
					case 1:	$_SESSION['userType']=1;
							$_SESSION['username']=$row['admin_username'];
							$fName=$row['admin_firstName'];
							$_SESSION['userFName']=$fName;
							break;

					case 2:	$_SESSION['userType']=2;
							$_SESSION['username']=$row['ucol_username'];
							$cmpid=$row['ucol_id'];
							$query="Select * from ".tableStudent." where (Select ucol_id from ".tableUser." where ucol_id=$cmpid)=stcol_id ";
							$row1=$this->fetchArray($this->execute($query));
							$fName=$row1['stcol_firstName'];
							$_SESSION['userFName']=$fName;
							break;
					case 3:	$_SESSION['userType']=3;
							$_SESSION['username']=$row['ucol_username'];
							$cmpid=$row['ucol_id'];
							$query="Select * from ".tableStaff." where (Select ucol_id from ".tableUser." where ucol_id=$cmpid)=stfcol_id ";
							$row1=$this->fetchArray($this->execute($query));
							$fName=$row1['stfcol_firstName'];
							$_SESSION['userFName']=$fName;
							break;
				}

				return 0;
			}						
		}

		function confirmUserName($username)
		{      		
      		/* Verify that user is in database */
      		$sql = "SELECT * FROM ".tableUser." WHERE username = '$username'";
      		$result = $this->execute($sql);

      		if(!$result || $this->totalRows($result) < 1)
      		{
         		return 1; //Indicates username failure
      		} 
	  
	 		return 0;
	   }

		function getUserInfo($user, $username, $password)
		{
			if($user==1)
			{
				$sql="Select * from ".tableAdmin." where (admin_username='$username' and admin_password='$password')";
			}

			if($user==2 || $user==3)
			{
				$sql="Select * from ".tableUser." where (ucol_username='$username' and ucol_password='$password')";				
			}

			$res=$this->execute($sql);
			$count=$this->totalRows($res);
      		
      		/* Error occurred, return given name by default */
      		if(!$res || $count < 1)
      		{
         		return NULL;
      		}
      		
      		/* Return result array */
      		$infoarray = $this->fetchArray($res);
      		return $infoarray;
  		}

  		function loginHistory($user, $username, $password, $ip)
  		{
  			if($user==1)
  			{
  				$sql="Select admin_id from ".tableAdmin." where (admin_username='$username' and admin_password='$password')";
  				$res=$this->execute($sql);
				$row=$this->fetchArray($res);

				$aid=$row['admin_id'];

				$query="INSERT into ".tableAdminLoginHistory." values ('$aid', '$ip', NOW()) ";	
				$result=$this->execute($query);
  			}

  			else
  			{
  				$sql="Select ucol_id from ".tableUser." where (ucol_username='$username' and ucol_password='$password')";
  				$res=$this->execute($sql);
				$row=$this->fetchArray($res);

				$uid=$row['ucol_id'];

				$query="INSERT into ".tableUserLoginHistory." values ('$uid', '$ip', NOW()) ";	
				$result=$this->execute($query);

  			}
  		}

  		function checkEmail($username, $email)
  		{
  			$sql=" Create View view_emailUserList as Select ucol_username as username, stfcol_emailId as email from ".tableUser." as user  
					inner join ".tableStaff." as staff on user.ucol_id=staff.stfcol_id
						union
					Select ucol_username as username, stcol_emailId as email from ".tableUser." as user  
					inner join ".tableStudent." as student on user.ucol_id=student.stcol_id";

			$res=$this->execute($sql);

			$query="Select email from view_emailUserList where username='$username' and email='$email'";
			$result=$this->execute($query);
			$udata=$this->fetchArray($result);

			$sql="drop view view_emailuserlist";
			$res=$this->execute($sql);

			$query="Select admin_emailId from ".tableAdmin." where admin_username='$username' and admin_emailId='$email'";
			$result=$this->execute($query);
			$adata=$this->fetchArray($result);

			if(!$udata && !$adata)
			{
				return 1;
			}
			
			/*generates random password*/
			//$new_pswd = substr( md5(uniqid(rand(),1)), 3, 10);
			$new_pswd=$this->randomKeys("20");
			if($adata)
			{
				$sql="UPDATE ".tableAdmin." SET admin_password= md5('$new_pswd') WHERE admin_username='$username'";
				$res=$this->execute($sql);
			}

			if($udata)
			{
				$sql="UPDATE ".tableUser." SET ucol_password=md5('$new_pswd') WHERE ucol_username='$username'";
				$res=$this->execute($sql);
			}

			return $new_pswd;
			
  		}

  		function randomKeys($length)
  		{
	   		$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	   		
	   		for($i=0;$i<$length;$i++)
	   		{
		 		$key = $pattern{rand(0,61)};
	   		}
	   		
	   		return md5($key);
		}



      	//* Get current date
		
		function currentDate()
		{ 
	
			return date('Y-m-d');
		}

		function mailerPhpStart($address, $subject, $message, $name)
		{
			//SMTP needs accurate times, and the PHP time zone MUST be set
			//This should be done in your php.ini, but this is how to do it if you don't have access to that
			date_default_timezone_set('Etc/UTC');

			//Create a new PHPMailer instance
			$mail = new PHPMailer();

			//Tell PHPMailer to use SMTP port 25
			$mail->IsSMTP();
 			$mail->Port       = 25;
       
			$mail->SetFrom(constant("mailFrom"), 'eInfoDesk Team');
			$mail->AddReplyTo(constant("mailReplyTo"), $_SESSION['userFName']);
			
			//Set who the message is to be sent to
			$mail->AddAddress($address, $name);
			
			//Set the subject line
			$mail->Subject = $subject;

			//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
			$mail->MsgHTML($message);
			
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			
			//Attach an image file
			//$mail->AddAttachment('images/phpmailer_mini.gif');

			//Send the message, check for errors
			if(!$mail->Send()) 
			{
  				echo "Mailer Error: " . $mail->ErrorInfo;
  				return 0;
			}
			else 
			{
  				return 1;
			}
		}

	}

	$funObj = new Functions;
	$funObj->connectDb();
	

?>