<?php 

    if($formObj->num_success >0)
    {?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
                                echo $formObj->success("send");
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>
<div class="content-header">
    <h2>Send SMS</h2>
</div>

<div class="content-body">
    <ul class="nav nav-tabs" id="smsTab">
      <li class="active"><a href="#sendAdmin" data-toggle="tab"><span class="sms-tab">Admin</span></a></li>
      <li><a href="#sendStaff" data-toggle="tab"><span class="sms-tab">Staff</span></a></li>
      <li><a href="#sendStudent" data-toggle="tab"><span class="sms-tab">Student</span></a></li>
    </ul>

    <div class="tab-content">
        <!--Admin send sms tab pane-->
        <div class="tab-pane active" id="sendAdmin">
            <form class="form-horizontal span11 sendSms" method="POST" action="index.php?page=sms/send_sms">
                
                <div class="control-group">
                    <label class="control-label" for="inTypeAd">Send to:</label>
                    <div class="controls">
                    <?php $smsType=$formObj->value("sms_type"); ?>
                        <select name="sms_type" id="inTypeAd">
                            <option selected disabled style="color: #aaa">Select Type</option>
                            <option value="1" <?php echo ($smsType=="1") ?' selected="selected"':''; ?>>All</option>
                            <option value="2" <?php echo ($smsType=="2") ?' selected="selected"':''; ?>>Select Admin</option>
                        </select>
                    </div>
                </div>
                <div class="span4 sms-sidebar pull-right" id="side-barAd">
                
                <?php 
                    $ret=$modDbObj->getuser(1);
                    $num=$funObj->totalRows($ret);
                    $totNum=$num;
                    while($data=$funObj->fetchArray($ret))
                    {?>
                        <label class="checkbox inline">
                            <input type="checkbox" name="select<?php echo $num;?>" value="<?php echo $data['admin_contactNo']; ?>"> 
                            <span><?php echo $data['admin_firstName']." ". $data['admin_lastName']; ?></span>
                        </label>
                        
                <?php 
                        $num--;
                    }
                ?>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inMessageAd">Message:</label>
                    <div class="controls">
                        <textarea rows="8" class="span6" placeholder="Type your message here." id="inMessageAd" name="sms_msg" maxlength="150"></textarea>                        
                        <br><span id="remainingAd" style="color: #468847">142 characters remaining</span>
                    </div>
                </div>
                <input type="hidden" name="selectTotal" value="<?php echo $totNum;?>">
                <input type="hidden" name="user_sms" value="1">
                <div class="span3"></div><input type="submit" name="sendSms" class="btn btn-info" value="Send">
                
            </form>
            
            

        </div>

        <!--Staff send sms tab pane-->
        <div class="tab-pane " id="sendStaff">
            <form class="form-horizontal span11 sendSms" method="POST" action="index.php?page=sms/send_sms">
                <div class="control-group">
                    <label class="control-label" for="inTypeStf">Send to:</label>
                    <div class="controls">
                    <?php $smsType=$formObj->value("sms_type"); ?>
                        <select name="sms_type" id="inTypeStf">
                            <option selected disabled style="color: #aaa">Select Type</option>
                            <option value="1" <?php echo ($smsType=="1") ?' selected="selected"':''; ?>>All</option>
                            <option value="2" <?php echo ($smsType=="2") ?' selected="selected"':''; ?>>Department</option>
                            <option value="3" <?php echo ($smsType=="3") ?' selected="selected"':''; ?>>Select Staff</option>
                        </select>
                    </div>
                </div>

                <div class="control-group" id="deptStaff" >
                    <label class="control-label" for="depts">Department:</label>
                    <div class="controls">
                    <?php $deptStf=$formObj->value("sms_deptStf"); ?>
                        <select  name="sms_deptStf" id="depts">
                            <option selected disabled style="color:#aaa" id="depts">Select Department</option>
                            <option value="LIB" <?php echo ($deptStf=="LIB") ?' selected="selected"':''; ?>>Library</option>
                            <option value="ACC" <?php echo ($deptStf=="ACC") ?' selected="selected"':''; ?>>Account</option>
                            <option value="BARCH" <?php echo ($deptStf=="BARCH") ?' selected="selected"':''; ?>>Architecture</option>
                            <option value="BCT" <?php echo ($deptStf=="BCT") ?' selected="selected"':''; ?>>Computer</option>
                            <option value="BEX" <?php echo ($deptStf=="BEX") ?' selected="selected"':''; ?>>Electronics</option>
                            <option value="BCE" <?php echo ($deptStf=="BCE") ?' selected="selected"':''; ?>>Civil</option>
                            <option value="CSIT" <?php echo ($deptStf=="CSIT") ?' selected="selected"':''; ?>>CSIT</option>
                        </select> 
                    </div>
                </div>
                
                <div class="span4 sms-sidebar pull-right" id="side-barStf">
                
                <?php 
                    $ret=$modDbObj->getuser(3);
                    $num=$funObj->totalRows($ret);
                    $totNum=$num;
                    while($data=$funObj->fetchArray($ret))
                    {?>
                        <label class="checkbox inline">
                            <input type="checkbox" name="select<?php echo $num;?>" value="<?php echo $data['stfcol_contactNo']; ?>"> 
                            <span><?php echo $data['stfcol_firstName']." ". $data['stfcol_lastName']. " ";
                                        switch($data['stfcol_department'])
                                        {
                                            case "BCT": echo "(Department of Computer Engineering) <br>";
                                                        break;
                                            case "BEX": echo "(Department of Electronics Engineering) <br>";
                                                        break;
                                            case "BCE": echo "(Department of Civil Engineering) <br>";
                                                        break;
                                            case "BARCH": echo "(Department of Architecture) <br>";
                                                        break;
                                            case "CSIT":  echo "(Computer Science and Information Technology) <br>";
                                                        break;
                                            case "ACC": echo "(Account Department)<br>";
                                                        break;
                                            case "LIB": echo "(Library Department)<br>";
                                                        break;
                                        }
                                 ?></span>
                        </label>
                        <br>
                <?php 
                        $num--;
                    }
                ?>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inMessageStf">Message:</label>
                    <div class="controls">
                        <textarea rows="8" class="span6" placeholder="Type your message here." id="inMessageStf" name="sms_msg" maxlength="150"></textarea>                        
                        <br><span id="remainingStf" style="color: #468847">142 characters remaining</span>
                    </div>
                </div>
                <input type="hidden" name="selectTotal" value="<?php echo $totNum;?>">
                <input type="hidden" name="user_sms" value="3">
                <div class="span3"></div><input type="submit" name="sendSms" class="btn btn-info" value="Send">
                
            </form>        
        </div>

        <!-- Student send sms tab pane-->
        <div class="tab-pane " id="sendStudent">
            <form class="form-horizontal span11 sendSms" method="POST" action="index.php?page=sms/send_sms">
                <div class="control-group">
                    <label class="control-label" for="inTypeSt">Send to:</label>
                    <div class="controls">
                    <?php $smsType=$formObj->value("sms_type"); ?>
                        <select name="sms_type" id="inTypeSt">
                            <option selected disabled style="color: #aaa">Select Type</option>
                            <option value="1" <?php echo ($smsType=="1") ?' selected="selected"':''; ?>>All</option>
                            <option value="2" <?php echo ($smsType=="2") ?' selected="selected"':''; ?>>Department</option>
                            <option value="3" <?php echo ($smsType=="3") ?' selected="selected"':''; ?>>Level</option>
                            <option value="4" <?php echo ($smsType=="4") ?' selected="selected"':''; ?>>Select Student</option>
                        </select>
                    </div>
                </div>

                <div class="control-group" id="deptStudent" >
                    <label class="control-label" for="dept">Department:</label>
                    <div class="controls">
                    <?php $deptSt=$formObj->value("sms_deptSt"); ?>
                        <select  name="sms_deptSt" id="dept">
                            <option selected disabled style="color:#aaa" id="dept">Select Department</option>
                            <option value="BARCH" <?php echo ($deptSt=="BARCH") ?' selected="selected"':''; ?>>Architecture</option>
                            <option value="BCT" <?php echo ($deptSt=="BCT") ?' selected="selected"':''; ?>>Computer</option>
                            <option value="BEX" <?php echo ($deptSt=="BEX") ?' selected="selected"':''; ?>>Electronics</option>
                            <option value="BCE" <?php echo ($deptSt=="BCE") ?' selected="selected"':''; ?>>Civil</option>
                            <option value="CSIT" <?php echo ($deptSt=="CSIT") ?' selected="selected"':''; ?>>CSIT</option>
                        </select> 
                    </div>
                </div>

                <div class="control-group" id="level">
                    <label class="control-label" for="ilevel">Level:</label>
                    <div class="controls">
                    <?php $sms_level=$formObj->value("sms_level"); ?>
                        <select name="sms_level" id="ilevel">
                            <option selected disabled style="color: #aaa">Select Level</option>
                            <option value="1" <?php echo ($sms_level==1) ?' selected="selected"':''; ?>>First</option>
                            <option value="2" <?php echo ($sms_level==2) ?' selected="selected"':''; ?>>Second</option>
                            <option value="3" <?php echo ($sms_level==3) ?' selected="selected"':''; ?>>Third</option>
                            <option value="4" <?php echo ($sms_level==4) ?' selected="selected"':''; ?>>Fourth</option>
                            <option value="5" <?php echo ($sms_level==5) ?' selected="selected"':''; ?> id="arcLevel">Fifth</option>
                
                        </select>
                    </div>
                </div>


                <div class="span4 sms-sidebar pull-right" id="side-barSt">
                
                <?php 
                    $ret=$modDbObj->getuser(2);
                    $num=$funObj->totalRows($ret);
                    $totNum=$num;
                    while($data=$funObj->fetchArray($ret))
                    {?>
                        <label class="checkbox inline">
                            <input type="checkbox" name="select<?php echo $num;?>" value="<?php echo $data['stcol_contactNo']; ?>"> 
                            <span><?php echo $data['stcol_firstName']." ". $data['stcol_lastName']. " (".$data['stcol_rollNo'].")"; ?></span>
                        </label>
                        <br>
                <?php 
                        $num--;
                    }
                ?>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inMessageSt">Message:</label>
                    <div class="controls">
                        <textarea rows="8" class="span6" placeholder="Type your message here." id="inMessageSt" name="sms_msg" maxlength="150"></textarea>                        
                        <br><span id="remainingSt" style="color: #468847">142 characters remaining</span>
                    </div>
                </div>
                <input type="hidden" name="selectTotal" value="<?php echo $totNum;?>">
                <input type="hidden" name="user_sms" value="2">
                <div class="span3"></div><input type="submit" name="sendSms" class="btn btn-info" value="Send">
                
            </form>
        </div>

    </div>

</div>

<script>
  $(function () {
    $('#smsTab a:last').tab('show');
  })
</script>

<?php
  include("modules/modules-js.php"); 
?>

