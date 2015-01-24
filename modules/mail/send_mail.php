<!--display progress bar whilw sms is sending-->
<div class="progress progress-striped active">
    <div class="bar" style="width: 100%;"></div>
</div>
<?php

    if(isset($_POST['sendMail']))
    {   
       
        $user=$_POST['user_mail'];
        $smsTo=$_POST['mail_type'];  // getting what value of selected from user to send sms to?
        $subject=$_POST['mail_subject'];
        $message=$_POST['mail_msg'];
      
        $countS=0;//count succesful message sent
        $countF=0; //count failed message sent
  
        if($smsTo==1)//if all is selected
        {   
            $ret=$modDbObj->getUser($user);
            while($data=$funObj->fetchArray($ret))
            {   
                if($user==1)
                {
                    $address=$data['admin_emailId'];
                    $name=$data['admin_firstName']." ". $data['admin_lastName'];
                }
                if($user==2)
                {
                    $address=$data['stcol_emailId'];
                    $name=$data['stcol_firstName']." ". $data['stcol_lastName'];
                }

                if($user==3)
                {
                    $address=$data['stfcol_emailId'];
                    $name=$data['stfcol_firstName']." ". $data['stfcol_lastName'];
                }

                $send=$funObj->mailerPhpStart($address, $subject, $message, $name);

                if($send==0)
                    $countF++; 

                else
                    $countS++;
            }
            
        }

        //if specific person is selected or chosen
        else if(($user==1 && $smsTo==2) || ($user==2 && $smsTo==4) || ($user==3 && $smsTo==3))
        {
            $tot=$_POST['selectTotal'];//getting total no of rows that can be selected
            while($tot>0)
            {   
                $select="select".$tot;//making the name of select users
                if(isset($_POST[$select]))
                {
                    $address=$_POST[$select];
                    $name="";
                    
                    $send=$funObj->mailerPhpStart($address, $subject, $message, $name);

                    if($send==0)
                        $countF++; 

                    else
                        $countS++;
                }
                $tot--;
            }
        }

        else if($user==3 && $smsTo==2)//if staff selects  dept is selected
        {
            $dept=$_POST['mail_deptStf'];
            
            $ret=$modDbObj->getUserDept($user, $dept);
            while($data=$funObj->fetchArray($ret))
            {   
                $address=$data['stfcol_emailId'];
                $name=$data['stfcol_firstName']." ". $data['stfcol_lastName'];
                
                $send=$funObj->mailerPhpStart($address, $subject, $message, $name);

                if($send==0)
                    $countF++; 

                else
                    $countS++;
            }
        }

        else if($user==2 && $smsTo==3 && isset($_POST['mail_level']) )//if for student selects level
        {   
            $dept=$_POST['mail_deptSt'];
            $level=$_POST['mail_level'];
            $ret=$modDbObj->getUserDeptLevel($dept, $level);

            while($data=$funObj->fetchArray($ret))
            {
                $address=$data['stcol_emailId'];
                $name=$data['stcol_firstName']. " ". $data['stcol_lastName'];

                $send=$funObj->mailerPhpStart($address, $subject, $message, $name);

                if($send==0)
                    $countF++; 

                else
                    $countS++;            
            }
        }

        if($user==2 && $smsTo=2 && !isset($_POST['mail_level']))//if student selects  dept is selected
        {
            $dept=$_POST['mail_deptSt'];
            $ret=$modDbObj->getUserDept($user, $dept);
            while($data=$funObj->fetchArray($ret))
            {
                $address=$data['stcol_emailId'];
                $name=$data['stcol_firstName']." ". $data['stcol_lastName'];

                $send=$funObj->mailerPhpStart($address, $subject, $message, $name);

                if($send==0)
                    $countF++; 

                else
                    $countS++;
            }
        }

        

        $success_type="send";
        $formObj-> setSuccessMsg($success_type, "$countS mails are send!");

        $success_type="failed";
        $formObj-> setSuccessMsg($success_type, "$countF mails are failed to send!"); 

        $_SESSION['success_array']= $formObj->getSuccessArray();

        $funObj->redirect("index.php?page=mail/mail");
    }
?>