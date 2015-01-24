<?php
	if($_SESSION['userType']==1)
	{
?>

<?php 

	if($formObj->num_success >0)
    {?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
                                echo $formObj->success("addSchedule");
                                if($formObj->success("addSchedule"))
                                {?>
									<a href="index.php?page=class_schedule/add_schedule"><?php   echo "Add more Schedules" ?></a><?php
                                }
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>
<div class="content-header">
	<h2>Schedules</h2>
</div>

<div class="content-body">
	<div class="span4">
		<a href="index.php?page=class_schedule/view_schedule"> View Schedules</a>
		<p> View class routines and lab routines</p>
	</div>

	<div class="span4">
		<a href="index.php?page=class_schedule/add_schedule"> Add Schedules</a>
		<p> Add updated class routines and lab routines</p>
	</div>

	<div class="span4">
		<a href="index.php?page=class_schedule/update_schedule"> Update Schedules</a>
		<p> Edit the schedules if any errors or delete the schedule if it has been expired.</p>
	</div>

</div>	

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


