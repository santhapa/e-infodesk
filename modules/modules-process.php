<?php
	
	class ProcessModules
	{
   		function ProcessModules()
   		{
   			global $formObj, $funObj, $modDbObj;
        //Schedules process starts
      		if(isset($_POST['scheduleUpload']))
      		{
      			
         		$retval=$this->uploadSchedule();
         		if(!$retval)
         		{
         			$success_type="addSchedule";
         			$formObj-> setSuccessMsg($success_type, "Schedule succesfully added.");         			
         			$_SESSION['success_array']= $formObj->getSuccessArray();
          		
              $funObj->redirect("index.php?page=class_schedule/schedule");

         		}
         		else
         		{
         			$_SESSION['value_array'] = $_POST;
            	$_SESSION['error_array'] = $formObj->getErrorArray();
            
           		$funObj->redirect("index.php?page=class_schedule/add_schedule");
         		}
      		}

          if(isset($_POST['scheduleView']))
          {
            $type=mysqli_real_escape_string($funObj->connectDb(), $_POST['schedule_viewType']);

            $ret=$this->viewSchedule($type);  


            if(!$ret)
            {
              $error_type="search";
              $formObj->setError($error_type,"Searched Results are not found. Search again.");
              $_SESSION['value_array']=$_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();


              $funObj->redirect("index.php?page=class_schedule/view_schedule");

            }

            else
            {
              $success_type="search";
              $formObj-> setSuccessMsg($success_type, "The search results remains untill you 'Refresh' the page.");               
              $_SESSION['success_array']= $formObj->getSuccessArray();
              $_SESSION['value_array']=$_POST;
        
              $funObj->redirect("index.php?page=class_schedule/view_schedule_result"); 
            }
                               
          }

          if(isset($_POST['scheduleUpdate']))
          {
            $id = $_POST['userId'];
            $ret=$this->checkScheduleFormError();

            if($ret==1)
            {
              $_SESSION['value_array'] = $_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();
              $id=base64_encode($id);
              $funObj->redirect("index.php?page=class_schedule/edit_delete_schedule&action=edit&row=$id");
            }
            $department=strtoupper($_POST['schedule_dept']);
            $level=$_POST['schedule_level'];
            $section=strtoupper($_POST['schedule_section']);
            $imageData="";

            if(is_uploaded_file ($_FILES['image']['tmp_name']))
            {
              $imageData=$this->checkImageCompatible(); //checks error occured in image upload 
  
              if($imageData==1)
              {
                $_SESSION['value_array'] = $_POST;
                $_SESSION['error_array'] = $formObj->getErrorArray();
                $id=base64_encode($id);
                $funObj->redirect("index.php?page=class_schedule/edit_delete_schedule&action=edit&row=$id");
                die();
              }
            }

            $modDbObj->updateSchedule($id, $department, $level, $section, $imageData);            
          }  

          //Schedules process Ends

          //User Process Starts

          if(isset($_POST['userAdd']))
          {
            
            $retval=$this->userAdd();
            if(!$retval)
            {
              $success_type="addUser";
              $formObj-> setSuccessMsg($success_type, "User succesfully added.");               
              $_SESSION['success_array']= $formObj->getSuccessArray();
              
              $funObj->redirect("index.php?page=user/user");

            }
            else
            {
              $_SESSION['value_array'] = $_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();
            
              $funObj->redirect("index.php?page=user/add_user");
            }
          }

          if(isset($_POST['userUpdate']))
          {
            $id = mysqli_real_escape_string($funObj->connectDb(), $_POST['userID']);
            $userType=mysqli_real_escape_string($funObj->connectDb(), $_POST['userType']);
            $ret=$this->checkUserFormError();

            if($ret==1)
            {
              $_SESSION['value_array'] = $_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();
              $id=base64_encode($id);
              $userType=base64_encode($userType);
              $funObj->redirect("index.php?page=user/edit_delete_user&action=edit&row=$id&user=$userType");
            }
            $fname=mysqli_real_escape_string($funObj->connectDb(), $_POST['fname']);
            $lname=mysqli_real_escape_string($funObj->connectDb(), $_POST['lname']);
            $email=mysqli_real_escape_string($funObj->connectDb(), $_POST['email']);
            $contact=mysqli_real_escape_string($funObj->connectDb(), $_POST['contact']);
            $dob=mysqli_real_escape_string($funObj->connectDb(), $_POST['dob']);
            $permAddress=mysqli_real_escape_string($funObj->connectDb(), $_POST['permAddress']);
            $tempAddress=mysqli_real_escape_string($funObj->connectDb(), $_POST['tempAddress']);
            $batch=mysqli_real_escape_string($funObj->connectDb(), $_POST['batch']);
            if($userType==2)
              $deptStudent=mysqli_real_escape_string($funObj->connectDb(), $_POST['departmentStudent']);
            else
              $deptStudent="";
            $roll=mysqli_real_escape_string($funObj->connectDb(), $_POST['roll']);
            $fatherName=mysqli_real_escape_string($funObj->connectDb(), $_POST['fatherName']);
            $motherName=mysqli_real_escape_string($funObj->connectDb(), $_POST['motherName']);
            $guardianName=mysqli_real_escape_string($funObj->connectDb(), $_POST['guardianName']);
            if($userType==3)
              $deptStaff=mysqli_real_escape_string($funObj->connectDb(), $_POST['departmentStaff']);
            else
              $deptStaff="";
            $jobPosition=mysqli_real_escape_string($funObj->connectDb(), $_POST['jobPosition']);
            $workTime=mysqli_real_escape_string($funObj->connectDb(), $_POST['workTime']);
            $bio=mysqli_real_escape_string($funObj->connectDb(), $_POST['bio']);
            $imageData="";

            if(is_uploaded_file ($_FILES['image']['tmp_name']))
            {
              $imageData=$this->checkImageCompatible(); //checks error occured in image upload 
  
              if($imageData==1)
              {
                $_SESSION['value_array'] = $_POST;
                $_SESSION['error_array'] = $formObj->getErrorArray();
                $id=base64_encode($id);
                $userType=base64_encode($userType);
                $funObj->redirect("index.php?page=user/edit_delete_user&action=edit&row=$id&user=$userType");
              }
            }
            if($_POST['back'])
              $back=$_POST['back'];//for back when user edit their profile themselves
            else 
              $back="";

            $userData=array(  
                            "fname" => $fname, 
                            "lname" =>$lname,
                            "email" =>$email, 
                            "contact" => $contact,
                            "dob" => $dob, 
                            "permAddress" =>$permAddress,
                            "tempAddress" =>$tempAddress, 
                            "batch" => $batch,
                            "deptStudent" => $deptStudent, 
                            "roll" =>$roll,
                            "fatherName" =>$fatherName, 
                            "motherName" => $motherName,
                            "guardianName" => $guardianName, 
                            "deptStaff" =>$deptStaff,
                            "jobPosition" =>$jobPosition, 
                            "workTime" => $workTime,
                            "bio" => $bio, 
                            "back" => $back,
                          ); 
            $modDbObj->updateUser($userType, $id,  $userData, $imageData);            
          } 

          if(isset($_POST['searchUserAdmin']) || isset($_POST['searchUserStudent']) || isset($_POST['searchUserStaff']))
          {
            $searchString=strtolower($_POST['userSearch']);
            $user=mysqli_real_escape_string($funObj->connectDb(), $_POST['user']);

            $modDbObj->searchUser($user, $searchString);

            $funObj->redirect("index.php?page=user/user_search");
          }

          if(isset($_POST['changeAccount']))
          {
            $password=mysqli_real_escape_string($funObj->connectDb(), md5($_POST['password']))  ;
            $repassword=mysqli_real_escape_string($funObj->connectDb(), md5($_POST['repassword']));

            if($password!=$repassword)
            {
              $error_type="passwordMismatch";
              $formObj->setError($error_type,"Password mismatch. Re-enter your password.");
              $_SESSION['value_array'] = $_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();
              $funObj->redirect("index.php?page=user/user_account");
              die();
            }
            
            $username=mysqli_real_escape_string($funObj->connectDb(), $_POST['username']);

            $modDbObj->changeUserAccount($username, $password);
          }

//////////News and notices process
          if(isset($_POST['noticeAdd']))  //add news
          { 
            
            $retval=$this->noticeAdd();
            
            if(!$retval)
            {
              $success_type="addNotice";
              $formObj->setSuccessMsg($success_type,"Notice is saved!");
              $_SESSION['success_array']=$formObj->getSuccessArray();
           
              $funObj->redirect("index.php?page=notice/notice");
            }
         
            else
            {
              $error_type="formEmpty";
              $formObj->setError($error_type,"Please fill all the fields.");
              $_SESSION['value_array']=$_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();
           
              $funObj->redirect("index.php?page=notice/add_notice");

            }
          
          }

          if(isset($_POST['noticeUpdate']))
          {
            $ret=$this->noticeUpdate();
            $id=mysqli_real_escape_string($funObj->connectDb(), $_POST['noticeID']);
            $orgAuthor=mysqli_real_escape_string($funObj->connectDb(), $_POST['orgAuthor']);

            if(!$ret)
            {
              $error_type="formEmpty";
              $formObj->setError($error_type,"Please fill all the fields.");
              $_SESSION['value_array']=$_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();
           
              $funObj->redirect("index.php?page=notice/edit_delete_notice&author=$orgAuthor&action=edit&row=base64_encode($id)");
            }

            else
            {
              $success_type="updateNotice";
              $formObj->setSuccessMsg($success_type,"Notice is saved!");
              $_SESSION['success_array']=$formObj->getSuccessArray();
           
              $funObj->redirect("index.php?page=notice/notice");
            }

            
          }

///////////Notes processes
          if(isset($_POST['noteAdd']))  //add news
          { 
            
            $retval=$this->noteAdd();
            
            if(!$retval)
            {
              $success_type="addNote";
              $formObj->setSuccessMsg($success_type,"Note is published!");
              $_SESSION['success_array']=$formObj->getSuccessArray();
           
              $funObj->redirect("index.php?page=note/note");
            }
         
            else
            {
              $error_type="formEmpty";
              $formObj->setError($error_type,"Please fill all the fields.");
              $_SESSION['value_array']=$_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();
           
              $funObj->redirect("index.php?page=note/add_note");

            }
          
          }


          if(isset($_POST['noteUpdate']))
          {
            $ret=$this->noteUpdate();
            $id=mysqli_real_escape_string($funObj->connectDb(), $_POST['noteID']);
            $orgAuthor=mysqli_real_escape_string($funObj->connectDb(), $_POST['orgAuthor']);

            if(!$ret)
            {
              $error_type="formEmpty";
              $formObj->setError($error_type,"Please fill all the fields.");
              $_SESSION['value_array']=$_POST;
              $_SESSION['error_array'] = $formObj->getErrorArray();
           
              $funObj->redirect("index.php?page=note/edit_delete_note&author=$orgAuthor&action=edit&row=base64_encode($id)");
            }

            else
            {

              $success_type="updateNote";
              $formObj->setSuccessMsg($success_type,"Note is saved!");
              $_SESSION['success_array']=$formObj->getSuccessArray();
           
              $funObj->redirect("index.php?page=note/note");
            }            
          }

   		}

       function checkImageCompatible()
        {      
          global $formObj;    
          $error_type="imageUpload";
          if(is_uploaded_file ($_FILES['image']['tmp_name']))
          {
            //getting image size
            $maxsize=$_POST['maxFileSize'];   
            $size=$_FILES['image']['size'];
 
            // getting the image info extension
            $imgdetails = getimagesize ($_FILES['image']['tmp_name']);
            $img_type = $imgdetails['mime']; 
        
            // checking for valid image type
        
            if(($img_type=='image/jpeg')||($img_type=='image/gif'))
            {
    
              // checking for size again
              if($size<$maxsize)
              {
                $imgName=$_FILES['image']['name']; 
                $img =addslashes  (file_get_contents ($_FILES['image']['tmp_name']));
                $imgType=$img_type;
                $imgSize=addslashes ($imgdetails[3]);
           
                $imgData=array(
                                "imgName" =>$imgName, 
                                "img" => $img,
                                "imgType" => $imgType, 
                                "imgSize" =>$imgSize,
                              );           
                     
                return $imgData;
              }

              else
              {
                $formObj->setError($error_type, "Image to be uploaded is too large. Error uploading the image!!");
                return 1;
              }
            }

            else
            {
              $formObj->setError($error_type, "Not a valid image file! Please upload jpeg or gif image.");
              return 1;
            }
          }

          else
          {     
            switch($_FILES['image']['error'])
            {
              case 0: //no error; possible file attack!
                      $formObj->setError($error_type, "There was a problem with your upload.");
                      break;
              case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
                      $formObj->setError($error_type, "The file you are trying to upload is too big.");
                      break;
              case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
                      $formObj->setError($error_type, "The file you are trying to upload is too big.");
                      break;
              case 3: //uploaded file was only partially uploaded
                      $formObj->setError($error_type, "The file you are trying upload was only partially uploaded.");
                      break;
              case 4: //no file was uploaded
                      $formObj->setError($error_type, "You must select an image to upload.");
                      break;
              default://a default error, just in case! 
                        $formObj->setError($error_type, "There was a problem with your upload.");
                        break;
              }
              return 1;
            }
          
          }

       //Schedules process function starts   

      function checkScheduleFormError()
      {
        global $formObj; 
        $department=strtoupper($_POST['schedule_dept']);
        $level=$_POST['schedule_level'];
        $section=strtoupper($_POST['schedule_section']);

        if(!$department || !$level || strlen($department = trim($department)) == 0 || strlen($level=trim($level))==0)
        {
          $error_type="formEmpty";
          $formObj->setError($error_type, "Required fields are not set.");
          return 1;
        }
      }

      function viewSchedule($view)
      {
        global $modDbObj, $funObj, $formObj;
        $department="";
        $level="";
        $section="";
        if($view==1)
          $department=mysqli_real_escape_string($funObj->connectDb(), strtoupper($_POST['schedule_dept']));
        
        if($view==2)
          $level=mysqli_real_escape_string($funObj->connectDb(), $_POST['schedule_level']);
        
        if($view==3)
        {
          $department=mysqli_real_escape_string($funObj->connectDb(), strtoupper($_POST['schedule_dept']));
          $level=mysqli_real_escape_string($funObj->connectDb(), $_POST['schedule_level']);
          $section=mysqli_real_escape_string($funObj->connectDb(), strtoupper($_POST['schedule_section']));
        }

        $res=$modDbObj->getSchedule($view, $department, $level, $section);
        $data=$funObj->fetchArray($res);

        return $data;
      }

   		function uploadSchedule()
   		{      		
      		global $formObj, $funObj, $modDbObj; 

          $ret=$this->checkScheduleFormError();

          if($ret==1)
          {
            return 1;
          }
      		$department=mysqli_real_escape_string($funObj->connectDb(), strtoupper($_POST['schedule_dept']));
        	$level=mysqli_real_escape_string($funObj->connectDb(), $_POST['schedule_level']);
        	$section=mysqli_real_escape_string($funObj->connectDb(), strtoupper($_POST['schedule_section']));

        	$imageData=$this->checkImageCompatible(); //checks error occured in image upload 

        	if($imageData==1)
        	{
        		return 1;
        	}

        	$retval=$modDbObj->addSchedule($department, $level, $section, $imageData);

          

        	if(!$retval)
        	{
        		return 0;
        	}
        		
        }

        //Schedules process function ends

        //User process function starts
        function checkUserFormError()
        {
          global $formObj; 

          $userType=$_POST['userType'];

          if($userType==1 || $userType==2 || $userType==3 )
          {
            if(isset($_POST['username']))
              $username=$_POST['username'];
            else
              $username="Null";
            if(isset($_POST['password']))
              $password=$_POST['password'];
            else
              $password="Null";
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $email=$_POST['email'];
            $contact=$_POST['contact'];

            if(!$username || !$password || !$fname || !$lname || !$email || !$contact ||
              strlen($username = trim($username)) == 0 || strlen($password=trim($password))==0 ||
              strlen($fname = trim($fname)) == 0 || strlen($lname=trim($lname))==0 ||
              strlen($email = trim($email)) == 0 || strlen($contact=trim($contact))==0
              )
            {
              $error_type="formEmpty";
              $formObj->setError($error_type, "Required fields are not set.");
              return 1;
            }
          }

          if($userType==2 || $userType==3)
          {
            $dob=$_POST['dob'];
            $permAddress=$_POST['permAddress'];
            $tempAddress=$_POST['tempAddress'];

            if(!$dob || !$permAddress || strlen($dob = trim($dob)) == 0 || strlen($permAddress=trim($permAddress))==0)
            {
              $error_type="formEmpty";
              $formObj->setError($error_type, "Required fields are not set.");
              return 1;
            }
          }

          if($userType==2)
          {
            $batch=$_POST['batch'];
            $deptStudent=$_POST['departmentStudent'];
            $roll=$_POST['roll'];
            $fatherName=$_POST['fatherName'];
            $motherName=$_POST['motherName'];
            $guardianName=$_POST['guardianName'];

            if(!$batch || !$deptStudent || !$roll || !$fatherName || !$motherName ||
              strlen($batch = trim($batch)) == 0 || strlen($deptStudent=trim($deptStudent))==0 ||
              strlen($roll  = trim($roll)) == 0 || strlen($fatherName=trim($fatherName))==0 ||
              strlen($motherName = trim($motherName)) == 0)
            {
              $error_type="formEmpty";
              $formObj->setError($error_type, "Required fields are not set.");
              return 1;
            }
          }

          if($userType==3)
          {
            $deptStaff=$_POST['departmentStaff'];
            $jobPosition=$_POST['jobPosition'];
            $workTime=$_POST['workTime'];
            $bio=$_POST['bio'];
            echo $deptStaff. $jobPosition . strlen($workTime). $bio;

            if(!$deptStaff || !$jobPosition ||
              strlen($deptStaff = trim($deptStaff)) == 0 || strlen($jobPosition=trim($jobPosition))==0 ||
              strlen($workTime = trim($workTime)) == 0)
            {
              $error_type="formEmpty";
              $formObj->setError($error_type, "Required fields are not set.");
              return 1;
            }
          }
        }

        function userAdd()
        {         
          global $formObj, $funObj, $modDbObj; 

          $ret=$this->checkUserFormError();

          if($ret==1)
          {
            return 1;
          }

          $userType=mysqli_real_escape_string($funObj->connectDb(), $_POST['userType']);
          $username=mysqli_real_escape_string($funObj->connectDb(), $_POST['username']);
          $password=mysqli_real_escape_string($funObj->connectDb(), md5($_POST['password']));
          $fname=mysqli_real_escape_string($funObj->connectDb(), $_POST['fname']);
          $lname=mysqli_real_escape_string($funObj->connectDb(), $_POST['lname']);
          $email=mysqli_real_escape_string($funObj->connectDb(), $_POST['email']);
          $contact=mysqli_real_escape_string($funObj->connectDb(), $_POST['contact']);
          $dob=mysqli_real_escape_string($funObj->connectDb(), $_POST['dob']);
          $permAddress=mysqli_real_escape_string($funObj->connectDb(), $_POST['permAddress']);
          $tempAddress=mysqli_real_escape_string($funObj->connectDb(), $_POST['tempAddress']);
          $batch=mysqli_real_escape_string($funObj->connectDb(), $_POST['batch']);
          if($userType==2)
            $deptStudent=mysqli_real_escape_string($funObj->connectDb(), $_POST['departmentStudent']);
          else
            $deptStudent="";
          $roll=mysqli_real_escape_string($funObj->connectDb(), $_POST['roll']);
          $fatherName=mysqli_real_escape_string($funObj->connectDb(), $_POST['fatherName']);
          $motherName=mysqli_real_escape_string($funObj->connectDb(), $_POST['motherName']);
          $guardianName=mysqli_real_escape_string($funObj->connectDb(), $_POST['guardianName']);
          if($userType==3)
            $deptStaff=mysqli_real_escape_string($funObj->connectDb(), $_POST['departmentStaff']);
          else
            $deptStaff="";
          $jobPosition=mysqli_real_escape_string($funObj->connectDb(), $_POST['jobPosition']);
          $workTime=mysqli_real_escape_string($funObj->connectDb(), $_POST['workTime']);
          $bio=mysqli_real_escape_string($funObj->connectDb(), $_POST['bio']);

          $imageData=$this->checkImageCompatible(); //checks error occured in image upload 

          if($imageData==1)
          {
            return 1;
          }

          $userData=array(  "username" =>$username, 
                            "password" => $password,
                            "fname" => $fname, 
                            "lname" =>$lname,
                            "email" =>$email, 
                            "contact" => $contact,
                            "dob" => $dob, 
                            "permAddress" =>$permAddress,
                            "tempAddress" =>$tempAddress, 
                            "batch" => $batch,
                            "deptStudent" => $deptStudent, 
                            "roll" =>$roll,
                            "fatherName" =>$fatherName, 
                            "motherName" => $motherName,
                            "guardianName" => $guardianName, 
                            "deptStaff" =>$deptStaff,
                            "jobPosition" =>$jobPosition, 
                            "workTime" => $workTime,
                            "bio" => $bio, 
                          ); 

          $retval=$modDbObj->addUser($userType, $userData, $imageData);

          

          if(!$retval)
          {
            return 0;
          }
            
        }

////////Notice processes
        function noticeAdd()
        {
      
          global $funObj, $modDbObj;
      
          $title=mysqli_real_escape_string($funObj->connectDb(), $_POST['notice_title']);
          $content= $_POST['notice_content'];
          $status= mysqli_real_escape_string($funObj->connectDb(), $_POST['notice_status']);

          if(!$status || !$content ||strlen($content = trim($content)) == 0 )
            return 1;

          $retval = $modDbObj->addNotice($title, $content, $status);//author and date name no need to pass
       
          if(!$retval)
          {
            return 0;
          }
       
        }        
       
        function noticeUpdate()
        {
          global $modDbObj;
          $title=mysqli_real_escape_string($funObj->connectDb(), $_POST['notice_title']);
          $content= $_POST['notice_content'];
          $status= mysqli_real_escape_string($funObj->connectDb(), $_POST['notice_status']);
          $id=mysqli_real_escape_string($funObj->connectDb(), $_POST['noticeID']);
          $orgAuthor=mysqli_real_escape_string($funObj->connectDb(), $_POST['orgAuthor']);

          if(!$content ||strlen($content = trim($content)) == 0 )
            return 0;

          if($orgAuthor==$_SESSION['userFName'])
            $author=$orgAuthor." (edited)";
          else
            $author=$orgAuthor." (edited by ". $_SESSION['userFName'].")";

          $retval=$modDbObj->updateNotice($id, $title, $content, $author, $status);

          if($retval==1)
            return 1;

          else
            return 0;
        }

////////Notice processes
        function noteAdd()
        {
      
          global $funObj, $modDbObj;
      
          $title=mysqli_real_escape_string($funObj->connectDb(), $_POST['note_title']);
          $body= $_POST['note_body'];

          if(!$body ||strlen($body = trim($body)) == 0 )
            return 1;

          $retval = $modDbObj->addNote($title, $body);//author and date name no need to pass
       
          if(!$retval)
          {
            return 0;
          }
       
        }

        function noteUpdate()
        {
          global $modDbObj;
          $title=mysqli_real_escape_string($funObj->connectDb(), $_POST['note_title']);
          $body= $_POST['note_body'];
          $id=mysqli_real_escape_string($funObj->connectDb(), $_POST['noteID']);
          $orgAuthor=mysqli_real_escape_string($funObj->connectDb(), $_POST['orgAuthor']);

          if(!$body ||strlen($body = trim($body)) == 0 )
            return 0;

          if($orgAuthor==$_SESSION['userFName'])
            $author=$orgAuthor." (edited)";
          else
            $author=$orgAuthor." (edited by ". $_SESSION['userFName'].")";

          $retval=$modDbObj->updateNote($id, $title, $body, $author);

          if($retval==1)
            return 1;

          else
            return 0;

        }

        
	};

$procModObj= new ProcessModules;

?>
