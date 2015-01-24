<?php

	if(isset($_POST['username']))//If a username has been submitted 
	{
		$userType=mysql_real_escape_string($_POST['userType']);	
		$username = mysql_real_escape_string($_POST['username']);//Some clean up :)
echo $username;
		//if($userType==1)
			$sql="Select * from ".tableAdmin." where admin_username='$username'";
		//else		
		//	$sql="Select * from ".tableUser." where ucol_username='$username'";

		$res=$funObj->execute($sql);

		//Query to check if username is available or not 
		if($funObj->totalRows($res))
		{

			return 1;//If there is a  record match in the Database - Not Available
		}

		else
		{
			return 0;//No Record Found - Username is available 
		}

	}

?>