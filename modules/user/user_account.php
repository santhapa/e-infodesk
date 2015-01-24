<div class="content-header">
  <h2>Account Settings</h2>
</div>

<div class="content-body">
	<form class="form-horizontal span11 changeAccount" method='POST'  action='index.php?page=modules-process'>
		<div class="control-group">
        	<label class="control-label" for="inputusername" >Username:</label>
        	<div class="controls">
          		<input type="text" id="inputusername" name="username" 
            		value="<?php 
                      if($formObj->value("username"))
                        echo $formObj->value("username");
                      else
                      	echo $_SESSION['username'];
                ?>"required>
                <span class="help-inline" id="username_status"><?php if($formObj->num_errors >0)  echo $formObj->error("userAvailability"); ?></span>
        	</div>
      	</div>

      	<div class="control-group">
        	<label class="control-label" for="inputpassword" >Password:</label>
        	<div class="controls">
          		<input type="password" id="inputpassword" name="password" required value="<?php echo $formObj->value("password"); ?>">
        	</div>
      	</div>

      	<div class="control-group">
        	<label class="control-label" for="inputrepassword" >Re- Enter Password:</label>
        	<div class="controls">
          		<input type="password" id="inputrepassword" name="repassword" required>
              <span class="help-inline" id="repassword_status"><?php if($formObj->num_errors >0)  echo $formObj->error("passwordMismatch"); ?></span>
        	</div>
      	</div>
      	<div class="span2"></div><button type="submit" class="btn btn-info span1" name="changeAccount" style="margin: 10px 0px 0px 10px">Save</button>
	</form>
     
</div>

<?php
	include("modules/modules-js.php");
?>
