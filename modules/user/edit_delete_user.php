
<?php 

  if($formObj->num_errors >0)
    {?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
                                echo $formObj->error("formEmpty");
                                echo $formObj->error("imageUpload");

                            ?>
            </strong></center>
        </div>
    <?php
    }
?>

<?php
	if(isset($_GET['row']))
	{
		$id=base64_decode($_GET['row']);
	}

  if(isset($_GET['user']))
  {
    $user=base64_decode($_GET['user']);    
  }

	if($_GET['action']=="delete")
	{	
    if($_SESSION['userType']==1)
		  $modDbObj->deleteUser($user, $id);
    else
    {?>
      <div class="pageError">
        <?php
          echo "Sorry, you are not authorized to view this page content.";
        ?>
      </div>
    <?php
    } 
      
  }

	else if($_GET['action']=="edit")
	{
		$res=$modDbObj->editUser($user, $id);
		$data=$funObj->fetchAssociate($res);
?>

<div class="content-header">
	<h2>Edit User</h2>
</div>

<div class="content-body">
	<div class="span6">
    <form class="form-horizontal span11 updateUser" enctype='multipart/form-data' method='POST'  action='index.php?page=modules-process'>
      <center><span>All * fields are requireds</span></center><br>
  
      <div class="control-group" id="updateUser">
        <label class="control-label" for="userType">User:</label>
        <div class="controls">
            <select  name="userType" id="userType">
            <?php 
              if($formObj->value("userType"))
                $userType=$formObj->value("userType");
              else
              $userType=$user; 
            ?> 
              <option selected disabled style="color:#aaa">Select User </option>
              <option value="1" <?php echo ($userType=="1") ?' selected="selected"':''; ?>>Admin</option>
              <option value="2" <?php echo ($userType=="2") ?' selected="selected"':''; ?>>Student</option>
              <option value="3" <?php echo ($userType=="3") ?' selected="selected"':''; ?>>Staff</option>
            </select>  
            <span class="help-inline">*</span>        
        </div>
      </div>

      <div class="control-group" id="fname">
        <label class="control-label" for="inputfname" >First name:</label>
        <div class="controls">
          <input type="text" placeholder="Sushil, Roshan Bahadur" id="inputfname" name="fname" 
            value="<?php 
                      if($formObj->value("fname"))
                        echo $formObj->value("fname");
                      else
                      {
                        switch($user)
                        {
                          case 1: echo $data['admin_firstName'];
                                  break;
                          case 2: echo $data['stcol_firstName'];
                                  break;
                          case 3: echo $data['stfcol_firstName'];
                                  break;
                        }
                      }
                    ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="lname">
        <label class="control-label" for="inputLname" >Last Name:</label>
        <div class="controls">
          <input type="text" placeholder="(eg:Shrestha,Thapa,karki)" id="inputLname" name="lname" 
            value="<?php 
                      if($formObj->value("lname"))
                        echo $formObj->value("lname");
                      else
                      {
                        switch($user)
                        {
                          case 1: echo $data['admin_lastName'];
                                  break;
                          case 2: echo $data['stcol_lastName'];
                                  break;
                          case 3: echo $data['stfcol_lastName'];
                                  break;
                        }
                      }
                    ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="batch">
        <label class="control-label" for="batche" >Batch:</label>
        <div class="controls">
          <input type="text" placeholder="YYYY(2067)" id="batche"  name="batch" 
            value="<?php 
                    if($formObj->value("batch"))
                        echo $formObj->value("batch");
                    else
                      {if($user==2) echo $data['stcol_batch'];} ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="departmentStudent" >
        <label class="control-label" for="dept">Department:</label>
        <div class="controls">
          <?php 
            if($formObj->value("departmentStudent"))
              $deptSt=$formObj->value("departmentStudent");
            else
             {if($user==2) $deptSt=$data['stcol_department'];} ?>
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
          <?php 
            if($formObj->value("departmentStaff"))
              $deptStf=$formObj->value("departmentStaff");
            else
              {if($user==3) $deptStf=$data['stfcol_department'];} ?>
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
          <input type="text" placeholder="Eg:1,2,3" id="rollNo" name="roll" 
            value="<?php if($formObj->value("roll"))
                          echo $formObj->value("roll");
                        else
                          { if($user==2) 
                            {
                              $roll=explode('/', $data['stcol_rollNo']);
                              echo $roll[2];
                            }
                           }?>">
          <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="dob">
        <label class="control-label" for="dofb">Date of Birth:</label>
        <div class="controls">
          <input type="text" placeholder="YYYY-MM-DD" id="dofb" name="dob" 
            value="<?php 
                      if($formObj->value("dob"))
                        echo $formObj->value("dob");
                      else
                      {
                        switch($user)
                        {
                          case 2: echo $data['stcol_dob'];
                                  break;
                          case 3: echo $data['stfcol_dob'];
                                  break;
                        }
                      }
                    ?>">
         <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="permAddress">
        <label class="control-label" for="padrs">Permanent Address:</label>
        <div class="controls">
          <input type="text" placeholder="Permanent Address" id="padrs" name="permAddress" 
            value="<?php 
                      if($formObj->value("permAddress"))
                        echo $formObj->value("permAddress");
                      else
                      {
                        switch($user)
                        {
                          case 2: echo $data['stcol_permAddress'];
                                  break;
                          case 3: echo $data['stfcol_permAddress'];
                                  break;
                        }
                      }
                    ?>" >
          <span class="help-inline">*</span>
        </div>
      </div>
  
      <div class="control-group" id="tempAddress">
        <label class="control-label" for="tempadrs">Temporary Address:</label>
        <div class="controls">
          <input type="text" placeholder="Temporary Address" id="tempadrs" name="tempAddress" 
            value="<?php 
                      if($formObj->value("tempAddress"))
                        echo $formObj->value("tempAddress");
                      else
                      {
                        switch($user)
                        {
                          case 2: echo $data['stcol_tempAddress'];
                                  break;
                          case 3: echo $data['stfcol_tempAddress'];
                                  break;
                        }
                      }
                    ?>">
        </div>
      </div>
   
      <div class="control-group" id="email">
        <label class="control-label" for="emailID">Email-Id:</label>
        <div class="controls">
          <input type="email" placeholder="name@example.com" id="emailID" name="email" 
            value="<?php 
                      if($formObj->value("email"))
                        echo $formObj->value("email");
                      else
                      {
                        switch($user)
                        {
                          case 1: echo $data['admin_emailId'];
                                  break;
                          case 2: echo $data['stcol_emailId'];
                                  break;
                          case 3: echo $data['stfcol_emailId'];
                                  break;
                        }
                      }
                    ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
   
      <div class="control-group" id="contact">
        <label class="control-label" for="contactNo">Contact No.:</label>
        <div class="controls">
          <input type="text" placeholder="Contact No." id="contactNo" name="contact" 
            value="<?php 
                      if($formObj->value("contact"))
                        echo $formObj->value("contact");
                      else
                      {
                        switch($user)
                        {
                          case 1: echo $data['admin_contactNo'];
                                  break;
                          case 2: echo $data['stcol_contactNo'];
                                  break;
                          case 3: echo $data['stfcol_contactNo'];
                                  break;
                        }
                      }
                    ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
   
      <div class="control-group" id="fatherName">
        <label class="control-label" for="fatname" >Father Name:</label>
        <div class="controls">
          <input type="text" placeholder="Surya Shrestha" id="fatname" name="fatherName" 
            value="<?php 
                    if($formObj->value("fatherName"))
                      echo $formObj->value("fatherName");
                    else
                      {if($user==2) echo $data['stcol_fatherName'];} ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
   
      <div class="control-group" id="motherName">
        <label class="control-label" for="motname" >Mother Name:</label>
        <div class="controls">
          <input type="text" placeholder="Shanti Shrestha" id="motname" name="motherName" 
            value="<?php 
                    if($formObj->value("motherName"))
                      echo $formObj->value("motherName");
                    else
                      { if($user==2) echo $data['stcol_motherName'];} ?>">
          <span class="help-inline">*</span>
        </div>
      </div>
   
      <div class="control-group" id="guardianName">
        <label class="control-label" for="gdnname" >Gurdian Name:</label>
        <div class="controls">
          <input type="text" placeholder="Santa Manandhar" id="gdnname" name="guardianName" 
            value="<?php 
                    if($formObj->value("guardianName"))
                        echo $formObj->value("guardianName");
                    else
                      {if($user==2) echo $data['stcol_guardianName'];} ?>">
        </div>
      </div>   
   
      <div class="control-group" id="jobPosition">
        <label class="control-label" for="jbposition" >Job Position:</label>
        <div class="controls">
          <?php 
            if($formObj->value("jobPosition"))
              $jobPosition=$formObj->value("jobPosition");
            else
              {if($user==3) $jobPosition=$data['stfcol_jobPosition'];} ?>
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
          <?php 
            if($formObj->value("workTime"))
              $workTime=$formObj->value("workTime");
            else
              {if($user==3) $workTime=$data['stfcol_workTime'];}  ?>
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
          <textarea placeholder="Write about yourself." id="ubio" name="bio" maxlength="480"><?php 
              if($formObj->value("bio"))
                echo $formObj->value("bio");
              else
                {if($user==3) echo $data['stfcol_bio'];} ?></textarea>
        </div>
      </div> 
   
      <div class="control-group" id="image">
        <label class="control-label" for="uimage">Image:</label>
        <div class="controls">
          <?php   
            switch($user)
            { 
              case 1: $img='data:image/jpeg;base64,' . base64_encode( $data['admin_image'] ) . '';
                      $imgName=$data['admin_image_name'];
                      break;
              case 2: $img='data:image/jpeg;base64,' . base64_encode( $data['stcol_image'] ) . '';
                      $imgName=$data['stcol_image_name'];
                      break;
              case 3: $img='data:image/jpeg;base64,' . base64_encode( $data['stfcol_image'] ) . '';
                      $imgName=$data['stfcol_image_name'];
                      break;
            }
          ?>
                <a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="btn btn-info span3">View</a>
            <button type="button" class="btn btn-info span6" name="editUser" id="changeUserImage" >Change Image</button>
            <span><?php echo $imgName; ?></span>
            
            <div id="showUserImage">
              <input type="file" accept='image/*' id="uimage" name="image" value="<?php echo $formObj->value("image") ?>" placeholder="Upload the user image">
              <span>Maximum image size 500KB.</span><span class="help-inline">*</span>
        </div>
      </div>
      <?php
      //for enabling user to update their profile by themselves
        if(isset($_GET['back'])=="edPro")
        {?>
          
        <input type="hidden" name="back" value="edPro">
      <?php  }
      ?>
      <input type="hidden" name="maxFileSize" value="524288">
      <input type="hidden" name="userID" value="<?php echo $id; ?>"> 
      <input type="hidden" name="userUpdate" value="1">
      <div class="span4"></div><button type="submit" class="btn btn-info span4" name="updateUser" style="margin: 10px 0px 0px 10px">Update</button>
    </form>

  </div>
</div>

<?php
  
  include("modules/modules-js.php");

	}
	
?>







   


