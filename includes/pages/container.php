<?php 

  if($formObj->num_success >0)
    {?>

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" data-delay="10">&times;</button>
            <center><strong><?php 
            
                                echo $formObj->success("accChange");
                                
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>

<div class="content-header">
    <h2>Dashboard</h2>
</div>

<div class="content-body span12">

	<!--disply only 4 box  first row-->
	<div class="span3 dashboard">
		<?php
			if($_SESSION['userType']==2)
			{?>
		<a href="index.php?page=class_schedule/view_schedule_result">
			<?php
			}
			if($_SESSION['userType']==3)
			{?>
		<a href="index.php?page=class_schedule/view_schedule">
			<?php
			}
			if($_SESSION['userType']==1)
			{
			?>
		<a href="index.php?page=class_schedule/schedule">
			<?php
			}?>
			<p class="dashboardTitle">
			<img src="img/schedule.jpeg" class="img-polaroid" id="dashboardImage" alt="schedule">
			
				<br><?php echo ($_SESSION['userType']==1)? "Manage Schedules" : "Class Schedule"; ?>
			</p>
		</a>
	</div>

	<div class="span3 dashboard">
		<a href="index.php?page=notice/notice">
			<p class="dashboardTitle">
			<img src="img/notice.jpg" class="img-polaroid" id="dashboardImage" alt="notice">
			
				<br><?php echo ($_SESSION['userType']==1)? "Manage Notices" : "Notices"; ?>
			</p>
		</a>
	</div>

	<?php if($_SESSION['userType']==1){?>
	<div class="span3 dashboard">
		<a href="index.php?page=sms/sms">
			<p class="dashboardTitle">
			<img src="img/sms.jpg" class="img-polaroid" id="dashboardImage" alt="sms">
				<br>SMS
			</p>
		</a>
	</div>

	<div class="span3 dashboard">
		<a href="index.php?page=mail/mail">
			<p class="dashboardTitle">
			<img src="img/mail.jpg" class="img-polaroid" id="dashboardImage" alt="mail">
				<br>Mail Box
			</p>
		</a>
	</div>
	<?php } ?>


	<!--disply only 4 box  second row-->
	<div class="span3 dashboard">
		<a href="index.php?page=note/note">
			<p class="dashboardTitle">
				<img src="img/note.jpg" class="img-polaroid" id="dashboardImage" alt="note">
				<br>Notes
			</p>
		</a>
	</div>






	
</div>
