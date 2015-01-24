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
    <h2>SMS Test</h2>
</div>

<div class="content-body">
    
    <form class="form-horizontal span11 sendSms" method="POST" action="index.php?page=sms/send_sms">
        <div class="control-group">
            <label class="control-label" for="inSourceName">Your Name:</label>
            <div class="controls">
                <input type="text" id="inSourceName" name="smsTest_name" maxlength="6" required value="<?php echo $formObj->value("smsTest_name");?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inSourceNo">Your Mobile No.:</label>
            <div class="controls">
                <input type="text" id="inSourceNo" maxlength="10" name="smsTest_sourceNo" required value="<?php echo $formObj->value("smsTest_sourceNo");?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inDestinationNo">Recipient's Mobile No.:</label>
            <div class="controls">
                <input type="text" id="inDestinationNo" name="smsTest_destNo" required value="<?php echo $formObj->value("smsTest_destNo");?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inMessage">Message:</label>
            <div class="controls">
                <textarea rows="8" class="span6" placeholder="Type your message here." id="inMessage" name="smsTest_msg" maxlength="140"></textarea>                        
                <br><span id="remaining" style="color: #468847">140 characters remaining</span>
            </div>
        </div>
        <div class="span3"></div><input type="submit" name="sendSmsTest" class="btn btn-info" value="Send Now">
                
    </form>
</div>

<?php
  include("modules/modules-js.php"); 
?>