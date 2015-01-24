<?php
  if($_SESSION['userType']==1||$_SESSION['userType']==3)
  {
?>
<?php 

  if($formObj->num_errors >0)
    {?>

        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
            
                                echo $formObj->error("search");

                            ?>
            </strong></center>
        </div>
    <?php
    }
?>

<div class="content-header">
	<h2>View Schedules</h2>
</div>

<div class="content-body">
  <div class="span6 offset8 ">
      <a href="index.php?page=class_schedule/view_schedule_all" name="viewScheduleAll"  class="viewLink">View All</a>
  </div>

  <div class="span6">
    <form class="form-horizontal span11 viewSchedule"  method='POST' action='index.php?page=modules-process'>
      
        <div class="control-group">
          <label class="control-label" for="viewType">View By:</label>
          <div class="controls">
              <?php $schedule_viewType=$formObj->value("schedule_viewType"); ?>
              <select name="schedule_viewType" id="viewType">
                <option selected disabled style="color: #aaa">Select Type</option>
                <option value="1" <?php echo ($schedule_viewType=="1") ?' selected="selected"':''; ?>>Department</option>
                <option value="2" <?php echo ($schedule_viewType=="2") ?' selected="selected"':''; ?>>Level</option>
                <option value="3" <?php echo ($schedule_viewType=="3") ?' selected="selected"':''; ?>>Class</option>
              </select>
        
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="department" id="lblDepartment">Department:</label>
          <div class="controls">
              <?php $schedule_dept=$formObj->value("schedule_dept"); ?>
              <select name="schedule_dept" id="department">
                <option selected disabled style="color: #aaa">Select Department</option>
                <option value="BCT" <?php echo ($schedule_dept=="BCT") ?' selected="selected"':''; ?>>Computer</option>
                <option value="BEX" <?php echo ($schedule_dept=="BEX") ?' selected="selected"':''; ?>>Electronics</option>
                <option value="BCE" <?php echo ($schedule_dept=="BCE") ?' selected="selected"':''; ?>>Civil</option>
                <option value="CSIT" <?php echo ($schedule_dept=="CSIT") ?' selected="selected"':''; ?>>CSIT</option>
                <option value="BARCH" <?php echo ($schedule_dept=="BARCH") ?' selected="selected"':''; ?>>Architecture</option>
              </select>
        
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="level" id="lblLevel">Level:</label>
          <div class="controls">
              <?php $schedule_level=$formObj->value("schedule_level"); ?>
              <select name="schedule_level" id="level">
                <option selected disabled style="color: #aaa">Select Level</option>
                <option value="1" <?php echo ($schedule_level==1) ?' selected="selected"':''; ?>>First</option>
                <option value="2" <?php echo ($schedule_level==2) ?' selected="selected"':''; ?>>Second</option>
                <option value="3" <?php echo ($schedule_level==3) ?' selected="selected"':''; ?>>Third</option>
                <option value="4" <?php echo ($schedule_level==4) ?' selected="selected"':''; ?>>Fourth</option>
                <option value="5" <?php echo ($schedule_level==5) ?' selected="selected"':''; ?> id="archLevel">Fifth</option>
              </select>
            
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="section" id="lblSection">Section:</label>
          <div class="controls">
            <input type="text" id="section" name="schedule_section" placeholder="Type class section if any" value="<?php echo $formObj->value("schedule_section"); ?>">
          </div>
        </div>
        
        <input type="hidden" name="scheduleView" value="1">
        <div class="span4"></div><button type="submit" class="btn btn-info span5" name="viewSchedule" >View</button>
    </form>
  <div>
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

