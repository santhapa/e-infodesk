<!--display progress bar whilw sms is sending-->
<div class="progress progress-striped active">
    <div class="bar" style="width: 100%;"></div>
</div>
<?php

    if(isset($_POST['sendSms']))
    {
        $userSms = constant("smsUsername");
        $pass = constant("smsPassword");
        $type = constant("smsType");
        $dlr = constant("smsDlr");
        $src = constant("smsSource");
        
        $user=$_POST['user_sms'];
        $smsTo=$_POST['sms_type']; // getting what value of selected from user to send sms to?
        $count=0;
        $message=$_POST['sms_msg']."\n-eInfoDesk Team";

        if($smsTo==1)//if all is selected
        {   
            $ret=$modDbObj->getUser($user);
            while($data=$funObj->fetchArray($ret))
            {   
                if($user==1)
                    $contact="977".$data['admin_contactNo'];
                if($user==2)
                    $contact="977".$data['stcol_contactNo'];
                if($user==3)
                    $contact="977".$data['stfcol_contactNo'];

                $smssend = $modDbObj->sendSMS($userSms, $pass, $type, $dlr, $contact, $src, $message);
                
                $count++; 
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
                    $contact="977".$_POST[$select];
                    $smssend = $modDbObj->sendSMS($userSms, $pass, $type, $dlr, $contact, $src, $message);
                    $count++;
                    echo $smssend;
                }
                $tot--;
            }
        }

        else if($user==3 && $smsTo==2)//if staff selects  dept is selected
        {
            $dept=$_POST['sms_deptStf'];
            
            $ret=$modDbObj->getUserDept($user, $dept);
            while($data=$funObj->fetchArray($ret))
            {   
                $contact="977".$data['stfcol_contactNo'];
                $smssend = $modDbObj->sendSMS($userSms, $pass, $type, $dlr, $contact, $src, $message);
                $count++;
            }
        }

        else if($user==2 && $smsTo==3 && isset($_POST['sms_level']) )//if for student selects level
        {   
            $dept=$_POST['sms_deptSt'];
            $level=$_POST['sms_level'];
            $ret=$modDbObj->getUserDeptLevel($dept, $level);

            while($data=$funObj->fetchArray($ret))
            {
                $contact="977".$data['stcol_contactNo'];
                $smssend = $modDbObj->sendSMS($userSms, $pass, $type, $dlr, $contact, $src, $message);    
                $count++;            
            }
        }

        if($user==2 && $smsTo=2 && !isset($_POST['sms_level']))//if student selects  dept is selected
        {
            $dept=$_POST['sms_deptSt'];
            $ret=$modDbObj->getUserDept($user, $dept);
            while($data=$funObj->fetchArray($ret))
            {
                $contact="977".$data['stcol_contactNo'];
                $smssend = $modDbObj->sendSMS($userSms, $pass, $type, $dlr, $contact, $src, $message);
                $count++;
            }
        }

        

        $success_type="send";
        $formObj-> setSuccessMsg($success_type, "$count messages are send!"); 
        $_SESSION['success_array']= $formObj->getSuccessArray();

        $funObj->redirect("index.php?page=sms/sms");
    }
?>


<?php
////////for testing
    if(isset($_POST['sendSmsTest']))
    {
        $user = constant("smsUsername");
        $pass = constant("smsPassword");
        $type = constant("smsType");
        $dlr = constant("smsDlr");
        $src = constant("smsSource");

        $srcName=$_POST['smsTest_name'];
        $srcNo=$_POST['smsTest_sourceNo'];
        $destNo="977".$_POST['smsTest_destNo'];
        $message=$srcNo."\n".$_POST['smsTest_msg']."\n-". $srcName;

        
        $smssend = $modDbObj->sendSMS($user, $pass, $type, $dlr, $destNo, $src, $message);

        $success_type="send";
        $formObj-> setSuccessMsg($success_type, "Message is send!"); 
        $_SESSION['success_array']= $formObj->getSuccessArray();

        $funObj->redirect("index.php?page=sms/sms_test");


    }
?>