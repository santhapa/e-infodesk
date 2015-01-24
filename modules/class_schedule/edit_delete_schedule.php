
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

	if($_GET['action']=="delete")
	{	
		$modDbObj->deleteSchedule($id);
	}

	else if($_GET['action']=="edit")
	{
		$res=$modDbObj->specificSchedule($id);
		$data=$funObj->fetchAssociate($res);
?>

<div class="content-header">
	<h2>Edit Schedules</h2>
</div>

<div class="content-body">
	<div class="span6">
		<form class="form-horizontal span11 updateSchedule" enctype='multipart/form-data' method='POST' action='index.php?page=modules-process'>
			<center><span>All * fields are requireds</span></center><br>
			<div class="control-group">
    			<label class="control-label" for="department">Department:</label>
    			<div class="controls">
              <?php 
                if($formObj->value("schedule_dept"))
                  $schedule_dept=$formObj->value("schedule_dept");
                else
                  {$schedule_dept=$data['schedulecol_department'];} ?>
      				<select name="schedule_dept" id="department">
      					<option selected disabled style="color: #aaa">Select Department</option>
      					<option value="BCT" <?php echo ($schedule_dept=="BCT") ?' selected="selected"':''; ?>>Computer</option>
      					<option value="BEX" <?php echo ($schedule_dept=="BEX") ?' selected="selected"':''; ?>>Electronics</option>
      					<option value="BCE" <?php echo ($schedule_dept=="BCE") ?' selected="selected"':''; ?>>Civil</option>
      					<option value="CSIT" <?php echo ($schedule_dept=="CSIT") ?' selected="selected"':''; ?>>CSIT</option>
      					<option value="BARCH" <?php echo ($schedule_dept=="BARCH") ?' selected="selected"':''; ?>>Architecture</option>
      				</select>
      				<span class="help-inline">*</span>
    			</div>
  			</div>

  			<div class="control-group">
    			<label class="control-label" for="level">Level:</label>
    			<div class="controls">
              <?php 
                if($formObj->value("schedule_level"))
                  $schedule_level=$formObj->value("schedule_level");
                else
                  {$schedule_level=$data['schedulecol_level']; } ?>
      				<select name="schedule_level" id="level">
      					<option selected disabled style="color: #aaa">Select Level</option>
      					<option value="1" <?php echo ($schedule_level==1) ?' selected="selected"':''; ?>>First</option>
      					<option value="2" <?php echo ($schedule_level==2) ?' selected="selected"':''; ?>>Second</option>
      					<option value="3" <?php echo ($schedule_level==3) ?' selected="selected"':''; ?>>Third</option>
      					<option value="4" <?php echo ($schedule_level==4) ?' selected="selected"':''; ?>>Fourth</option>
                <option value="5" <?php echo ($schedule_level==5) ?' selected="selected"':''; ?> id="archLevel">Fifth</option>
      				</select>
      				<span class="help-inline">*</span>
    			</div>
  			</div>

  			<div class="control-group">
    			<label class="control-label" for="section">Section:</label>
    			<div class="controls">
    				<input type="text" id="section" name="schedule_section" placeholder="Type class section if any" 
              value="<?php 
                      if($formObj->value("schedule_section"))
                        echo $formObj->value("schedule_section");
                      else
                        {echo $data['schedulecol_section'];} ?>">
    			</div>
  			</div>

  			<div class="control-group">
    			<label class="control-label" for="schedule">Schedule:</label>
    			<div class="controls">
    				<?php 	$img='data:image/jpeg;base64,' . base64_encode( $data['schedulecol_image'] ) . '';
                  			$imgName=$data['schedulecol_image_name'];
           			?>
          			<a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="btn btn-info span3">View</a>
    				<button type="button" class="btn btn-info span6" name="addSchedule" id="changeImage" >Change Image</button>
            <span><?php echo $data['schedulecol_image_name'] ?></span>
    				
            <div id="showImage">
              <input type="file" accept='image/*' id="scheduleFile" name="image" placeholder="Upload the schedule image">
    					<span>Maximum image size 500KB.</span><span class="help-inline">*</span>
            </div>
    				
    			</div>
  			</div>
  			<input type="hidden" name="maxFileSize" value="524288">
        <input type="hidden" name="userId" value="<?php echo $id; ?>"> 
			  <input type="hidden" name="scheduleUpdate" value="1">
			<div class="span4"></div><button type="submit" class="btn btn-info span5" name="updateSchedule" >Update</button>
		</form>
	<div>
</div>

<?php
  
  include("modules/modules-js.php");

	}
	
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



   


