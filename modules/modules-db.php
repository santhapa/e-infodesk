<?php
	
	class Modules
	{
		//Schedules database calls starts
        function allSchedules()//to view all of the schedules
		{
			global $funObj;
			$sql="Select * from ".tableClassSchedule." order by schedulecol_level";
			$res=$funObj->execute($sql);
			return $res;
		}

        function specificSchedule($id)//for edit schedules option
        {
            global $funObj;
            $sql="Select * from ".tableClassSchedule." where schedulecol_id='$id'";
            $res=$funObj->execute($sql);
            return $res;
        }

		function addSchedule($dept, $lev, $sec, $img)//adding new schedules
        {
        	global $funObj;
          	$imgName=$img["imgName"];
          	$image=$img["img"];
          	$imgType=$img["imgType"];
          	$imgSize=$img["imgSize"];

        	$sql="Insert into ".tableClassSchedule." 
                (schedulecol_department, schedulecol_level, schedulecol_section, schedulecol_image_name, schedulecol_image, schedulecol_image_type,schedulecol_image_size)
        		    values ('$dept', '$lev', '$sec', '$imgName', '$image', '$imgType', '$imgSize' )";
        	$res=$funObj->execute($sql);

        	return 0;
        }

        function updateSchedule($id, $dept, $lev, $sec, $img )//updating schedules if anu mistake
        {
            global $funObj, $formObj;
            if(!$img)
            {
                $sql="Update ".tableClassSchedule." set 
                        schedulecol_department='$dept', schedulecol_level='$lev' , schedulecol_section='$sec' where schedulecol_id='$id'";
            }
            else
            {
                $imgName=$img["imgName"];
                $image=$img["img"];
                $imgType=$img["imgType"];
                $imgSize=$img["imgSize"];

                $sql="Update ".tableClassSchedule." set 
                        schedulecol_department='$dept', schedulecol_level='$lev' , schedulecol_section='$sec',
                        schedulecol_image_name='$imgName', schedulecol_image='$image', schedulecol_image_type='$imgType' ,schedulecol_image_size='$imgSize' where schedulecol_id='$id'";
            }
            
            $res=$funObj->execute($sql);

            $success_type="edit";
            $formObj-> setSuccessMsg($success_type, "Succesfully edited."); 
            $_SESSION['success_array']= $formObj->getSuccessArray();

            $funObj->redirect("index.php?page=class_schedule/update_schedule");
        }

        function deleteSchedule($id)//delete the old schedules
        {
           global $funObj, $formObj;
           
           $sql="Delete from ".tableClassSchedule." where schedulecol_id='$id' ";
           $funObj->execute($sql);

           $success_type="delete";
           $formObj-> setSuccessMsg($success_type, "Succesfully deleted."); 
           $_SESSION['success_array']= $formObj->getSuccessArray();

           $funObj->redirect("index.php?page=class_schedule/update_schedule");

        }

        function getSchedule($view, $dept, $lev, $sec)//get schedules when searched
        {
        	global $funObj;
        	if($view==1)
        	{
        		$sql="Select * from ".tableClassSchedule." where schedulecol_department='$dept' order by schedulecol_level";
        	}

        	if($view==2)
        	{
        		$sql="Select * from ".tableClassSchedule." where schedulecol_level='$lev' order by schedulecol_department";
        	}

        	if($view==3)
        	{
        		if(!$sec)
					$sql="Select * from ".tableClassSchedule." where schedulecol_department='$dept' and schedulecol_level='$lev'";
				
				else
					$sql="Select * from ".tableClassSchedule." where schedulecol_department='$dept' and schedulecol_level='$lev' and schedulecol_section='$sec'";
        	}

        	$res=$funObj->execute($sql);
        	
        	return $res;	
        }	

        function getStudentSchedule()//when student view his schedules
        {
            global $funObj;
            $username=$_SESSION['username'];

            $sql="Select * from view_student_contact where stcol_username='$username'";
            $res=$funObj->execute($sql);
            $data=$funObj->fetchArray($res);

            $dept=$data['stcol_department'];
            $currYear=(Date("Y"))+57;
            $lev=$currYear-$data['stcol_batch'];
            

            $query="Select * from ".tableClassSchedule." where schedulecol_department='$dept' and schedulecol_level='$lev'";
            $result=$funObj->execute($query);

            return $result;
        }
        //schedules database functions ends

///////////User database calls starts

        function addUser($userType, $userData, $img)//adding new users
        {
            global $funObj, $formObj;
            $username=$userData['username'];

            $data=$this->getUserProfile($userType, $username);
            if($data)
            {
                $error_type="userAvailability";
                $formObj->setError($error_type,"'$username' not available. Use another.");
                $_SESSION['value_array'] = $_POST;
                $_SESSION['error_array'] = $formObj->getErrorArray();
                $funObj->redirect("index.php?page=user/add_user");
            }

            $password=$userData['password'];
            $fname=$userData['fname'];
            $lname=$userData['lname'];
            $email=$userData['email']; 
            $contact=$userData['contact'];
            $dob=$userData['dob'];
            $permAddress=$userData['permAddress'];
            $tempAddress=$userData['tempAddress'];
            $batch=$userData['batch'];
            $deptStudent=$userData['deptStudent'];
            $roll=$userData['batch']."/".$userData['deptStudent']."/".$userData['roll']; 
            $fatherName=$userData['fatherName'];
            $motherName=$userData['motherName'];
            $guardianName=$userData['guardianName'];
            $deptStaff=$userData['deptStaff'];
            $jobPosition=$userData['jobPosition'];
            $workTime=$userData['workTime']; 
            $bio=$userData['bio'];


            $imgName=$img["imgName"];
            $image=$img["img"];
            $imgType=$img["imgType"];
            $imgSize=$img["imgSize"];


            if($userType==1)
            {
                $sql="Insert into ".tableAdmin." (admin_username, admin_password, admin_firstName, admin_lastName, admin_emailId, admin_contactNo, admin_image_name, admin_image, admin_image_type, admin_image_size)
                        values ('$username', '$password', '$fname', '$lname', '$email', '$contact', '$imgName', '$image', '$imgType', '$imgSize')";
            }

            if($userType==2)
            {
                $query="Insert into ".tableUser." (ucol_username, ucol_password, ucol_type)
                        values ('$username', '$password', 0)";
                $result=$funObj->execute($query);
                $q="Select ucol_id from ".tableUser." where ucol_username='$username'";
                $r=$funObj->execute($q);
                $u=$funObj->fetchAssociate($r);
                $id=$u['ucol_id'];

                $sql="Insert into ".tableStudent." (stcol_id, stcol_firstName, stcol_lastName, stcol_batch, stcol_department, stcol_rollNo, stcol_dob, stcol_permAddress, stcol_tempAddress, stcol_emailId, stcol_contactNo, stcol_fatherName, stcol_motherName, stcol_guardianName, stcol_image_name, stcol_image, stcol_image_type, stcol_image_size)
                        VALUES ('$id', '$fname', '$lname', '$batch', '$deptStudent','$roll','$dob', '$permAddress', '$tempAddress',  '$email', '$contact', '$fatherName', '$motherName', '$guardianName', '$imgName', '$image', '$imgType', '$imgSize') ";
            }

            if($userType==3)
            {
                $query="Insert into ".tableUser." (ucol_username, ucol_password, ucol_type)
                        values ('$username', '$password', 1)";
                $result=$funObj->execute($query);
                $q="Select ucol_id from ".tableUser." where ucol_username='$username'";
                $r=$funObj->execute($q);
                $u=$funObj->fetchAssociate($r);
                $id=$u['ucol_id'];

                $sql="Insert into ".tableStaff." (stfcol_id, stfcol_firstName, stfcol_lastName, stfcol_dob, stfcol_department, stfcol_jobPosition, stfcol_workTime, stfcol_permAddress, stfcol_tempAddress, stfcol_emailId, stfcol_contactNo, stfcol_bio, stfcol_image_name, stfcol_image, stfcol_image_type, stfcol_image_size)
                       VALUES ('$id', '$fname', '$lname', '$dob', '$deptStaff', '$jobPosition', '$workTime', '$permAddress', '$tempAddress',  '$email', '$contact', '$bio',  '$imgName', '$image', '$imgType', '$imgSize') ";
            }

           
            $res=$funObj->execute($sql);

            return 0;
        }

        function getUserProfile($user, $username)//to display the user profile
        {
            global $funObj;
            if($user==1)
            {
                $sql="Select * from ".tableAdmin." where admin_username='$username'";
            }

            if($user==2)
            {
                $sql="Select * from ".viewStudent." where stcol_username='$username'";
            }

            if($user==3)
            {
                $sql="Select * from ".viewStaff." where stfcol_username='$username'";
            }

            $res=$funObj->execute($sql);
            $data=$funObj->fetchArray($res);

            return $data;
        }

        function getUser($user)
        {
            global $funObj;
            if($user==1)
            {
                $sql="Select * from ".tableAdmin." order by admin_username";
            }

            if($user==2)
            {
                $sql="Select * from ".viewStudent." order by stcol_username";
            }

            if($user==3)
            {
                $sql="Select * from ".viewStaff." order by stfcol_username";
            }
            $res=$funObj->execute($sql);

            return $res;
        }

        function getUserDept($user, $dept)// get user info by department
        {
            global $funObj;
            if($user==2)
            {
                $sql="Select * from ".viewStudent." where stcol_department='$dept' order by stcol_username";
            }

            if($user==3)
            {
                $sql="Select * from ".viewStaff." where stfcol_department='$dept' order by stfcol_username";
            }

            $res=$funObj->execute($sql);

            return $res;
        }

        function getUserDeptLevel($dept, $lev)//get student info with depat and level
        {
            global $funObj;

            $currYear=(Date("Y"))+57;
            $batch=$currYear-$lev;
            $sql="Select * from ".viewStudent." where stcol_batch='$batch' and stcol_department='$dept'";
            $res=$funObj->execute($sql);

            return $res;
        }

        function deleteUser($user, $id)//delete the old schedules
        {
           global $funObj, $formObj;
           
           if($user==1)
           {
                $sql="Delete from ".tableAdmin." where admin_id='$id' ";
           }

           if($user==2 || $user==3)
           {
                $sql="Delete from ".tableUser." where ucol_id='$id' ";
           }
           
           $funObj->execute($sql);

           $success_type="delete";
           $formObj-> setSuccessMsg($success_type, "Succesfully deleted."); 
           $_SESSION['success_array']= $formObj->getSuccessArray();

           $funObj->redirect("index.php?page=user/update_user");

        }

        function editUser($user, $id)
        {
            global $funObj;
            if($user==1)
            {
                $sql="Select * from ".tableAdmin." where admin_id='$id' ";
            }

            if($user==2)
            {
                $sql="Select * from ".viewStudent." where stcol_id='$id'";
            }

            if($user==3)
            {
                $sql="Select * from ".viewStaff." where stfcol_id='$id'";
            }
            $res=$funObj->execute($sql);

            return $res;
        }

        function updateUser($user, $id,  $userData, $img)//updating user details if any mistake
        {
            global $funObj, $formObj;
            $fname=$userData['fname'];
            $lname=$userData['lname'];
            $email=$userData['email']; 
            $contact=$userData['contact'];
            $dob=$userData['dob'];
            $permAddress=$userData['permAddress'];
            $tempAddress=$userData['tempAddress'];
            $batch=$userData['batch'];
            $deptStudent=$userData['deptStudent'];
            $roll=$userData['batch']."/".$userData['deptStudent']."/".$userData['roll']; 
            $fatherName=$userData['fatherName'];
            $motherName=$userData['motherName'];
            $guardianName=$userData['guardianName'];
            $deptStaff=$userData['deptStaff'];
            $jobPosition=$userData['jobPosition'];
            $workTime=$userData['workTime']; 
            $bio=$userData['bio'];

            if($user==1)
            {
                $sql="UPDATE ".tableAdmin." SET admin_firstName='$fname', admin_lastName='$lname', 
                      admin_emailId='$email', admin_contactNo='$contact' where admin_id='$id' ";
            }

            if($user==2)
            {
                $sql="UPDATE ".tableStudent." set stcol_firstName='$fname', stcol_lastName='$lname', stcol_batch='$batch',
                    stcol_department='$deptStudent', stcol_rollNo='$roll', stcol_dob='$dob', stcol_permAddress='$permAddress',
                    stcol_tempAddress='$tempAddress', stcol_emailId='$email', stcol_contactNo='$contact', stcol_fatherName='$fatherName',
                    stcol_motherName='$motherName', stcol_guardianName='$guardianName' where stcol_id='$id' ";
            }

            if($user==3)
            {
                $sql="UPDATE ".tableStaff." set stfcol_firstName='$fname', stfcol_lastName='$lname', stfcol_dob='$dob',
                    stfcol_department='$deptStaff', stfcol_jobPosition='$jobPosition', stfcol_workTime='$workTime' , stfcol_permAddress='$permAddress',
                    stfcol_tempAddress='$tempAddress', stfcol_emailId='$email', stfcol_contactNo='$contact',stfcol_bio='$bio' where stfcol_id='$id' ";
            }

            $res=$funObj->execute($sql);
            
            if($img)
            {
                $imgName=$img["imgName"];
                $image=$img["img"];
                $imgType=$img["imgType"];
                $imgSize=$img["imgSize"];

                if($user==1)
                {
                    $query="UPDATE ".tableAdmin." SET admin_image_name='$imgName', admin_image='$image', 
                        admin_image_type='$imgType', admin_image_size='$imgSize' where admin_id='$id' ";
                }

                if($user==2)
                {
                    $query="UPDATE ".tableStudent." SET stcol_image_name='$imgName', stcol_image='$image', 
                        stcol_image_type='$imgType', stcol_image_size='$imgSize' where stcol_id='$id' ";
                }

                if($user==3)
                {
                    $query="UPDATE ".tableStaff." SET stfcol_image_name='$imgName', stfcol_image='$image', 
                        stfcol_image_type='$imgType', stfcol_image_size='$imgSize' where admin_id='$id' ";
                }
                 $result=$funObj->execute($query);
            }
            $success_type="edit";
            $formObj-> setSuccessMsg($success_type, "Succesfully edited."); 
            $_SESSION['success_array']= $formObj->getSuccessArray();

            $back=$userData['back'];//if user edit their profile by themselves they will be redirect to their profile page
            if($back=="edPro")
            {
                $_SESSION['userFName']=$fname;
                $funObj->redirect("index.php?page=user/user_profile"); 
                die();
            }  


            $funObj->redirect("index.php?page=user/update_user");
        }

        function searchUser($user, $string)
        {
            global $funObj;
            if($user==1)
            {
                $sql="Select * from ".tableAdmin." where admin_username like '%$string%' or admin_firstName like '%$string%' or admin_lastName like '%$string%'
                       or admin_contactNo like '%$string%' or admin_emailId like '%$string%' ";
            }

            if($user==2)
            {
                $sql="Select * from ".viewStudent." where stcol_username like '%$string%' or stcol_firstName like '%$string%' or stcol_lastName like '%$string%'
                       or stcol_contactNo like '%$string%' or stcol_emailId like '%$string%' or stcol_batch like '%$string%' or
                       stcol_department like '%$string%' or stcol_rollNo like '%$string%' or stcol_dob like '%$string%' or
                       stcol_permAddress like '%$string%' or stcol_tempAddress like '%$string%' or stcol_fatherName like '%$string%' or
                       stcol_motherName like '%$string%' or stcol_guardianName like '%$string%' or stcol_batch like '%$string%'";   
            }

            if($user==3)
            {
                $sql="Select * from ".viewStaff." where stfcol_username like '%$string%' or stfcol_firstName like '%$string%' or stfcol_lastName like '%$string%'
                       or stfcol_contactNo like '%$string%' or stfcol_emailId like '%$string%' or stfcol_jobPosition like '%$string%' or
                       stfcol_department like '%$string%' or stfcol_workTime like '%$string%' or stfcol_dob like '%$string%' or
                       stfcol_permAddress like '%$string%' or stfcol_tempAddress like '%$string%' or stfcol_bio like '%$string%'";   
            }

            $res=$funObj->execute($sql);

            return $res;
        }

        function changeUserAccount($username, $password)
        {
            global $funObj, $formObj;
            $user=$_SESSION['userType'];
            $data=$this->getUserProfile($user, $username);
            if($data && $_SESSION['username']!=$username)
            {
                $error_type="userAvailability";
                $formObj->setError($error_type,"'$username' not available. Use another.");
                $_SESSION['value_array'] = $_POST;
                $_SESSION['error_array'] = $formObj->getErrorArray();
                $funObj->redirect("index.php?page=user/user_account");
            }

            $ret=$this->getUserProfile($user, $_SESSION['username']);

            if($user==1)
            {
                $id=$ret['admin_id'];
                $sql="Update ".tableAdmin." set admin_username='$username' , admin_password='$password' where admin_id='$id'";                
            }
            if($user==2)
            {
                $id=$ret['stcol_id'];
                $sql="Update ".tableUser." set ucol_username='$username' , ucol_password='$password' where ucol_id='$id'";
            }
            if($user==3)
            {
                $id=$ret['stfcol_id'];
                $sql="Update ".tableUser." set ucol_username='$username' , ucol_password='$password' where ucol_id='$id'";
            }

            $funObj->execute($sql);
            $_SESSION['username']=$username;
            $success_type="accChange";
            $formObj-> setSuccessMsg($success_type, "Your changes have been saved.");                     
            $_SESSION['success_array']= $formObj->getSuccessArray();

            $funObj->redirect("index.php");

        }


////////News and notices modules database queries
        function allActiveNotice()
        {
            global $funObj;
            $sql="Select * from ".tableNotice." where noticecol_status= '1' order by noticecol_date desc";
            $res=$funObj->execute($sql);
            return $res;
        }

        function allInactiveNotice()
        {
            global $funObj;
            $sql="Select * from ".tableNotice." where noticecol_status= '0' order by noticecol_date desc";
            $res=$funObj->execute($sql);
            return $res;
        }

        function addNotice($title, $content, $status)//author name and date no need to pass they are passed directly
        {
            global $funObj;
            $author=$_SESSION['userFName'];
            if($status=="true")
                $sql="Insert into ".tableNotice." (noticecol_title, noticecol_content, noticecol_author, noticecol_date, noticecol_status)
                    values ('$title', '$content', '$author', NOW() ,1)";
            
            if($status=="false")
                $sql="Insert into ".tableNotice." (noticecol_title, noticecol_content, noticecol_author, noticecol_date, noticecol_status)
                    values ('$title', '$content', '$author', NOW() ,0)";
            $res=$funObj->execute($sql);

            return 0;
        }

        function deleteNotice($id)//delete the news
        {
           global $funObj, $formObj;
           
           $sql="Delete from ".tableNotice." where noticecol_id='$id' ";
           $funObj->execute($sql);

           $success_type="delete";
           $formObj-> setSuccessMsg($success_type, "Succesfully deleted."); 
           $_SESSION['success_array']= $formObj->getSuccessArray();

           $funObj->redirect("index.php?page=notice/notice");

        }

        function specificNotice($id)//for edit news selecting through id
        {
            global $funObj;
            $sql="Select * from ".tableNotice." where noticecol_id='$id'";
            $res=$funObj->execute($sql);
            return $res;
        }

        function updateNotice($id, $title, $content, $author, $status)
        {
            global $funObj;

            if($status=="true")
            {
                $sql="UPDATE ".tableNotice." set noticecol_title='$title', noticecol_content='$content',
                    noticecol_author='$author', noticecol_date = NOW(), noticecol_status= 1 where noticecol_id='$id'";
            }

            if($status=="false")
            {
                $sql="UPDATE ".tableNotice." set noticecol_title='$title', noticecol_content='$content',
                    noticecol_author='$author', noticecol_date = NOW(), noticecol_status= 0 where noticecol_id='$id'";
            }

            $res=$funObj->execute($sql);

            return 1;
        }

        function searchNotice($status, $searchString)//search processing
        {
            global $funObj;
            $sql="Select * from ".tableNotice." where noticecol_status='$status' and (noticecol_title like '%$searchString%' or 
                noticecol_content like '%$searchString%' or noticecol_author like '%$searchString%') order by noticecol_date desc ";

            $res=$funObj->execute($sql);

            return $res;
        }

/////////Notes Db function
        function allNote()
        {
            global $funObj;
            $sql="Select * from ".tableNote." order by notecol_date desc";
            $res=$funObj->execute($sql);
            return $res;
        }

        function specificNote($id)//for edit note selecting through id
        {
            global $funObj;
            $sql="Select * from ".tableNote." where notecol_id='$id'";
            $res=$funObj->execute($sql);
            return $res;
        }

        function addNote($title, $body)//author name and date no need to pass they are passed directly
        {
            global $funObj;
            $author= $_SESSION['userFName'];
            $editor= $_SESSION['username'];
            
            $sql="Insert into ".tableNote." (notecol_title, notecol_body, notecol_author, notecol_date, notecol_editor)
                values ('$title', '$body', '$author', NOW() , '$editor')";
            
            $res=$funObj->execute($sql);

            return 0;
        }

        function deleteNote($id)//delete the news
        {
           global $funObj, $formObj;
           
           $sql="Delete from ".tableNote." where notecol_id='$id' ";
           $funObj->execute($sql);

           $success_type="delete";
           $formObj-> setSuccessMsg($success_type, "Succesfully deleted."); 
           $_SESSION['success_array']= $formObj->getSuccessArray();

           $funObj->redirect("index.php?page=note/note");

        }

        function updateNote($id, $title, $body, $author)
        {
            global $funObj;

            $sql="UPDATE ".tableNote." set notecol_title='$title', notecol_body='$body',
                notecol_author='$author', notecol_date = NOW() where notecol_id='$id'";
            
            $res=$funObj->execute($sql);

            return 1;
        }

        function searchNote($searchString)//search processing
        {
            global $funObj;
            $sql="Select * from ".tableNote." where (notecol_title like '%$searchString%' or 
                notecol_body like '%$searchString%' or notecol_author like '%$searchString%') order by notecol_date desc ";

            $res=$funObj->execute($sql);

            return $res;
        }


/////////Sms db functions
        function sendSMS($user, $pass, $type, $dlr, $dest, $src, $mes) 
        {
            $ch = curl_init('http://121.241.242.114:8080/bulksms/bulksms');
            $content =  'username='.$user.
                        '&password='.$pass.
                        '&type='.$type.
                        '&dlr='.$dlr.
                        '&destination='.$dest.
                        '&source='.$src.
                        '&message='.$mes;
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec ($ch);
            curl_close ($ch);
            
            echo $ch;
            return $output;    
        }

	}

	$modDbObj= new Modules;

?>