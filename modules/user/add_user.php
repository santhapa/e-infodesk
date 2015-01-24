<?php
  if($_SESSION['userType']==1)
  {
?>
<?php 

	if($formObj->num_errors >0)
    {?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
                                echo $formObj->error("formEmpty");
                                echo $formObj->error("imageUpload");
                                echo "Re-check the fields!";

                            ?>
            </strong></center>
        </div>
    <?php
    }
?>


<div class="content-header">
	<h2>Add User</h2>
</div>
<div class="content-body">
	
		<form class="form-horizontal span11 addUser" enctype='multipart/form-data' method='POST'  action='index.php?page=modules-process'>
 	  <span style="margin-left: 180px">All * fields are requireds</span><br><br>
	
      <div class="control-group">
  		  <label class="control-label" for="userType">User:</label>
  		  <div class="controls">
  			    <select  name="userType" id="userType">
            <?php $userType=$formObj->value("userType"); ?> 
            	<option selected disabled style="color:#aaa">Select User </option>
		    	    <option value="1" <?php echo ($userType=="1") ?' selected="selected"':''; ?>>Admin</option>
              <option value="2" <?php echo ($userType=="2") ?' selected="selected"':''; ?>>Student</option>
		      	  <option value="3" <?php echo ($userType=="3") ?' selected="selected"':''; ?>>Staff</option>
          	</select>  
            <span class="help-inline">*</span>        
  		  </div>
	    </div>
      
      <div class="control-group" id="username">
  		  <label class="control-label" for="inputUsername" >Username:</label>
  		  <div class="controls">
  			  <input type="text" placeholder="Username" id="inputUsername"  name="username" value="<?php echo $formObj->value("username") ?>">
          <span class="help-inline" id="user_status"><?php if($formObj->num_errors >0)  echo $formObj->error("userAvailability"); ?> *</span>
  		  </div>
  	  </div>
  
    	<div class="control-group" id="password">
      	<label class="control-label" for="inputPassword" >Password:</label>
    	  <div class="controls">
      		<input type="password"  placeholder="Password" id="inputPassword" name="password" value="<?php echo $formObj->value("password") ?>">
    	    <span class="help-inline">*</span>
        </div>
  	  </div>

      <div class="control-group" id="fname">
  		  <label class="control-label" for="inputfname" >First name:</label>
  		  <div class="controls">
  			  <input type="text" placeholder="Sushil, Roshan Bahadur" id="inputfname" name="fname" value="<?php echo $formObj->value("fname") ?>">
  		    <span class="help-inline">*</span>
        </div>
  	  </div>
  
      <div class="control-group" id="lname">
 	 	    <label class="control-label" for="inputLname" >Last Name:</label>
  	 	  <div class="controls">
 	 		    <input type="text" placeholder="(eg:Shrestha,Thapa,karki)" id="inputLname" name="lname" value="<?php echo $formObj->value("lname") ?>">
 	 	      <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="batch">
  		  <label class="control-label" for="batche" >Batch:</label>
  		  <div class="controls">
  			  <input type="text" placeholder="YYYY(2067)" id="batche"  name="batch" value="<?php echo $formObj->value("batch") ?>">
  		    <span class="help-inline">*</span>
        </div>
      </div>
  
	    <div class="control-group" id="departmentStudent" >
  		  <label class="control-label" for="dept">Department:</label>
  		  <div class="controls">
          <?php $deptSt=$formObj->value("departmentStudent"); ?>
  			  <select  name="departmentStudent">
            <option selected disabled style="color:#aaa" id="dept">Select Department</option>
		    	  <option value="BARCH" <?php echo ($deptSt=="BARCH") ?' selected="selected"':''; ?>>Architecture</option>
            <option value="BCT" <?php echo ($deptSt=="BCT") ?' selected="selected"':''; ?>>Computer</option>
		      	<option value="BEX" <?php echo ($deptSt=="BEX") ?' selected="selected"':''; ?>>Electronics</option>
            <option value="BCE" <?php echo ($deptSt=="BCE") ?' selected="selected"':''; ?>>Civil</option>
            <option value="CSIT" <?php echo ($deptSt=="CSIT") ?' selected="selected"':''; ?>>CSIT</option>
          </select>
          <span class="help-inline">*</span> 
  		  </div>
	    </div>

      <div class="control-group" id="departmentStaff" >
        <label class="control-label" for="depts">Department:</label>
        <div class="controls">
          <?php $deptStf=$formObj->value("departmentStaff"); ?>
          <select  name="departmentStaff">
            <option selected disabled style="color:#aaa" id="depts">Select Department</option>
            <option value="LIB" <?php echo ($deptStf=="LIB") ?' selected="selected"':''; ?>>Library</option>
            <option value="ACC" <?php echo ($deptStf=="ACC") ?' selected="selected"':''; ?>>Account</option>
             <option value="BARCH" <?php echo ($deptStf=="BARCH") ?' selected="selected"':''; ?>>Architecture</option>
            <option value="BCT" <?php echo ($deptStf=="BCT") ?' selected="selected"':''; ?>>Computer</option>
            <option value="BEX" <?php echo ($deptStf=="BEX") ?' selected="selected"':''; ?>>Electronics</option>
            <option value="BCE" <?php echo ($deptStf=="BCE") ?' selected="selected"':''; ?>>Civil</option>
            <option value="CSIT" <?php echo ($deptStf=="CSIT") ?' selected="selected"':''; ?>>CSIT</option>
          </select> 
          <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="roll">
  		  <label class="control-label" for="rollNo" >Roll no.:</label>
     	  <div class="controls">
      		<input type="text" placeholder="Eg:1,2,3" id="rollNo" name="roll" value="<?php echo $formObj->value("roll") ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="dob">
        <label class="control-label" for="dofb">Date of Birth:</label>
        <div class="controls">
       		<input type="text" placeholder="YYYY-MM-DD" id="dofb" name="dob" value="<?php echo $formObj->value("dob") ?>">
    	   <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="permAddress">
  		  <label class="control-label" for="padrs">Permanent Address:</label>
     	  <div class="controls">
      		<input type="text" placeholder="Permanent Address" id="padrs" name="permAddress" value="<?php echo $formObj->value("permAddress") ?>" >
          <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="tempAddress">
  		  <label class="control-label" for="tempadrs">Temporary Address:</label>
     	  <div class="controls">
      		<input type="text" placeholder="Temporary Address" id="tempadrs" name="tempAddress" value="<?php echo $formObj->value("tempAddress") ?>">
        </div>
      </div>
   
      <div class="control-group" id="email">
  		  <label class="control-label" for="emailID">Email-Id:</label>
     	  <div class="controls">
      		<input type="email" placeholder="name@example.com" id="emailID" name="email" value="<?php echo $formObj->value("email") ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
   
      <div class="control-group" id="contact">
  		  <label class="control-label" for="contactNo">Contact No.:</label>
     	  <div class="controls">
      		<input type="text" placeholder="Contact No." id="contactNo" name="contact" value="<?php echo $formObj->value("contact") ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
   
      <div class="control-group" id="fatherName">
  		  <label class="control-label" for="fatname" >Father Name:</label>
     	  <div class="controls">
      		<input type="text" placeholder="Surya Shrestha" id="fatname" name="fatherName" value="<?php echo $formObj->value("fatherName") ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
   
      <div class="control-group" id="motherName">
  		  <label class="control-label" for="motname" >Mother Name:</label>
     	  <div class="controls">
      		<input type="text" placeholder="Shanti Shrestha" id="motname" name="motherName" value="<?php echo $formObj->value("motherName") ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
   
      <div class="control-group" id="guardianName">
  		  <label class="control-label" for="gdnname" >Gurdian Name:</label>
     	  <div class="controls">
      		<input type="text" placeholder="Santa Manandhar" id="gdnname" name="guardianName" value="<?php echo $formObj->value("guardianName") ?>">
        </div>
      </div>   
   
      <div class="control-group" id="jobPosition">
  		  <label class="control-label" for="jbposition" >Job Position:</label>
     	  <div class="controls">
          <?php $jobPosition=$formObj->value("jobPosition"); ?>
          <select  name="jobPosition" id="jbPosition" >
            <option selected disabled style="color:#aaa">Select </option>
            <option value="Accountant" <?php echo ($jobPosition=="Accountant") ?' selected="selected"':''; ?>>Accountant</option>
            <option value="Teacher" <?php echo ($jobPosition=="Teacher") ?' selected="selected"':''; ?>>Teacher</option>
            <option value="HOD" <?php echo ($jobPosition=="HOD") ?' selected="selected"':''; ?>>Head of Department</option>
            <option value="Receptionist" <?php echo ($jobPosition=="Receptionist") ?' selected="selected"':''; ?>>Receptionist</option>
            <option value="Librarian" <?php echo ($jobPosition=="Librarian") ?' selected="selected"':''; ?>>Librarian</option>
            <option value="Principal" <?php echo ($jobPosition=="Principal") ?' selected="selected"':''; ?>>Principal</option>           
          </select>
          <span class="help-inline">*</span>
      	</div>
      </div> 
   
      <div class="control-group" id="workTime">
  		  <label class="control-label" for="worktime">Work time:</label>
  		  <div class="controls">
          <?php $workTime=$formObj->value("workTime"); ?>
  			  <select  name="workTime" id="worktime">
            <option selected disabled style="color:#aaa">Select </option>
		    	  <option value="0" <?php echo ($workTime=="0") ?' selected="selected"':''; ?>>Part Time</option>
            <option value="1" <?php echo ($workTime=="1") ?' selected="selected"':''; ?>>Full Time</option>		      	
          </select>
          <span class="help-inline">*</span>
  		  </div>
	    </div>
   
      <div class="control-group" id="bio">
  	   	<label class="control-label" for="ubio">Bio</label>
     	  <div class="controls">
      		<textarea placeholder="Write about yourself." id="ubio" name="bio" maxlength="480"><?php echo $formObj->value("bio") ?></textarea>
        </div>
      </div> 
   
      <div class="control-group" id="image">
    		<label class="control-label" for="uimage">Image:</label>
    		<div class="controls">
    			<input type="file" accept='image/*' id="uimage" name="image" value="<?php echo $formObj->value("image") ?>" placeholder="Upload the user image">
    			<span class="help-inline">Maximum image size 500KB.*</span>
    		</div>
  		</div>
   		
      <input type="hidden" name="maxFileSize" value="524288">
			<input type="hidden" name="userAdd" value="1">
			<div class="span2"></div><button type="submit" class="btn btn-info span1" name="addUser" >Add</button>
    </form>

  
</div>


<?php
  include("modules/modules-js.php"); 
?>


<?php
  }

  else
  {?>
    <div class="pageError">
      <?php
        echo "Sorry, you are not authorized to view this page content.";
      ?>
    <div>
    <?php 
  }
?>