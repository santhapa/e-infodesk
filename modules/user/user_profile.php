<?php 

  if($formObj->num_success >0)
    {?>

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" data-delay="10">&times;</button>
            <center><strong><?php 
                                echo $formObj->success("edit");
                                
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>

<?php
	if(isset($_GET['back']))
	{?>
		<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" data-delay="10">&times;</button>
            <center><strong>
            	<?php if($_GET['back']=="vill")
            		{?>
            		<a href="index.php?page=user/view_user_all"><?php   echo "Go back!" ?></a> 
            	<?php }
            		if($_GET['back']=="up")
            		{?>
            		<a href="index.php?page=user/update_user"><?php   echo "Go back!" ?></a>
            	<?php } 
            		if($_GET['back']=="sch")
            		{?>	
            		<a href="index.php?page=user/user_search&user=<?php echo  $_GET['user']; ?>&string=<?php echo $_GET['string']; ?>"><?php   echo "Go back!" ?></a>
            	<?php } ?>
            </strong></center>
        </div>
	<?php }
?>
<div class="content-header">
	<h2>User Profile</h2>
</div>

<div class="content-body">
	<div class="userProfile  span10" style="margin: 0 0 10px 150px">
		<?php
			if(isset($_GET['user']))
				$user=base64_decode($_GET['user']);
			else
				$user=$_SESSION['userType'];

			if(isset($_GET['username']))
				$username=base64_decode($_GET['username']);
			else
				$username=$_SESSION['username'];
		
			$data=$modDbObj->getUserProfile($user, $username);
//////////////////Students profile view
			if($user==2)
			{
				$id=base64_encode($data['stcol_id']);
				$img='data:image/jpeg;base64,' . base64_encode( $data['stcol_image'] ) . '';
				$imgName=$data['stcol_image_name'];

			?>
			<div class="span3">
				<a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage">
					<img src="<?php echo $img;?>" class="img-polaroid" width="180px" height="180px">
				</a>
			</div>
		
			<div class="span9">
				<?php
					echo "<p class='userName'>";
					echo $data['stcol_firstName']." ".$data['stcol_lastName']; 
					echo "</p>";
					echo "<p class='userHead'>";
					switch($data['stcol_department'])
					{
						case "BCT":	echo "Department of Computer Engineering <br>";
									break;
						case "BEX":	echo "Department of Electronics Engineering <br>";
									break;
						case "BCE":	echo "Department of Civil Engineering <br>";
									break;
						case "BARCH":	echo "Department of Architecture <br>";
									break;
						case "CSIT":	echo "Computer Science and Information Technology <br>";
									break;
					}

					echo "<br>"."Batch: ".$data['stcol_batch']."<br>";
					echo "<br> Roll: ".$data['stcol_rollNo']."<br> </p>";
				?>
			</div>
			<div>
				<div class="span10">
					<table class="table table-striped tblUserProfile" >
    					<tr>
      						<td class="span4 tdLeft">Username: </td>
      						<td class="span8 tdRight"><?php echo $data['stcol_username']; ?></td>
    					</tr>
    					<tr class="info">
      						<td class="span4 tdLeft">Date of Birth: </td>
      						<td class="span8 tdRight"><?php echo $data['stcol_dob']; ?></td>
    					</tr>
    					<tr>
      						<td class="span4 tdLeft">Permanent Address: </td>
      						<td class="span8 tdRight"><?php echo $data['stcol_permAddress']; ?></td>
    					</tr>
    					<tr class="info">
      						<td class="span4 tdLeft">Temporary Address: </td>
      						<td class="span8 tdRight"><?php 
      														if($data['stcol_tempAddress'])
      															echo $data['stcol_tempAddress'];
      														else 														 	# code...
      															echo $data['stcol_permAddress'];
      													?>
      						</td>
    					</tr>
    					<tr>
      						<td class="span4 tdLeft">Email Address: </td>
      						<td class="span8 tdRight"><?php echo $data['stcol_emailId']; ?></td>
    					</tr>
    					<tr class="info">
      						<td class="span4 tdLeft">Contact No.: </td>
      						<td class="span8 tdRight"><?php echo $data['stcol_contactNo']; ?></td>
    					</tr>
						<tr>
      						<td class="span4 tdLeft">Father Name: </td>
      						<td class="span8 tdRight"><?php echo $data['stcol_fatherName']; ?></td>
    					</tr>
    					<tr class="info">
      						<td class="span4 tdLeft">Mother Name: </td>
      						<td class="span8 tdRight"><?php echo $data['stcol_motherName']; ?></td>
    					</tr> 
    					<?php if($data['stcol_guardianName'])
    					{ ?>
    					<tr>
      						<td class="span4 tdLeft">Guardian Name: </td>
      						<td class="span8 tdRight"><?php echo $data['stcol_guardianName']; ?></td>
    					</tr>
    					<?php } ?>   					
    				</table> 
				</div>	
			</div>			
		
		<?php }
///////// Staff profile View
			if($user==3)
			{
				$id=base64_encode($data['stfcol_id']);
				$img='data:image/jpeg;base64,' . base64_encode( $data['stfcol_image'] ) . '';
				$imgName=$data['stfcol_image_name'];
			?>
			<div class="span3">
				<a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage">
					<img src="<?php echo $img;?>" class="img-polaroid" width="180px" height="180px">
				</a>
			</div>
		
			<div class="span9">
				<?php
					echo "<p class='userName'>";
					echo $data['stfcol_firstName']." ".$data['stfcol_lastName']; 
					echo "</p>";
					echo "<p class='userHead'>";
					switch($data['stfcol_department'])
					{
						case "BCT":	echo "Department of Computer Engineering <br>";
									break;
						case "BEX":	echo "Department of Electronics Engineering <br>";
									break;
						case "BCE":	echo "Department of Civil Engineering <br>";
									break;
						case "BARCH":	echo "Department of Architecture <br>";
									break;
						case "CSIT":	echo "Computer Science and Information Technology <br>";
									break;
						case "ACC":	echo "Account Department<br>";
									break;
						case "LIB":	echo "Library Department<br>";
									break;
					}

					echo "<br>"."Position: ".$data['stfcol_jobPosition']."<br> </p>";
				?>
			</div>
			<div>
				<div class="span10">
					<table class="table table-striped tblUserProfile" >
    					<tr>
      						<td class="span4 tdLeft">Username: </td>
      						<td class="span8 tdRight"><?php echo $data['stfcol_username']; ?></td>
    					</tr>
    					<tr class="info">
      						<td class="span4 tdLeft">Date of Birth: </td>
      						<td class="span8 tdRight"><?php echo $data['stfcol_dob']; ?></td>
    					</tr>
    					<tr>
      						<td class="span4 tdLeft">Permanent Address: </td>
      						<td class="span8 tdRight"><?php echo $data['stfcol_permAddress']; ?></td>
    					</tr>
    					<tr class="info">
      						<td class="span4 tdLeft">Temporary Address: </td>
      						<td class="span8 tdRight"><?php 
      														if($data['stfcol_tempAddress'])
      															echo $data['stfcol_tempAddress'];
      														else 														 	# code...
      															echo $data['stfcol_permAddress'];
      													?>
      						</td>
    					</tr>
    					<tr>
      						<td class="span4 tdLeft">Email Address: </td>
      						<td class="span8 tdRight"><?php echo $data['stfcol_emailId']; ?></td>
    					</tr>
    					<tr class="info">
      						<td class="span4 tdLeft">Contact No.: </td>
      						<td class="span8 tdRight"><?php echo $data['stfcol_contactNo']; ?></td>
    					</tr>
    					<?php if($data['stfcol_bio'])
    					{ ?>
    					<tr>
      						<td class="span4 tdLeft">Bio: </td>
      						<td class="span8 tdRight"><?php echo $data['stfcol_bio']; ?></td>
    					</tr>
    					<tr class="info">
      						<td class="span4 tdLeft">Work Time: </td>
      						<td class="span8 tdRight"><?php 
      														switch($data['stfcol_workTime'])
      														{
      															case 0: echo "Part Time";
      																	break;
      															case 1: echo "Full Time";
      																	break;
      														}
      												 ?>
      						</td>
    					</tr>
    					<?php } ?>   					
    				</table> 
				</div>	
			</div>
		<?php } 
/////////////admin profile view
			if(!isset($_GET['user']))
			{
			if($_SESSION['userType']==1)
			{
				$id=base64_encode($data['admin_id']);
				$img='data:image/jpeg;base64,' . base64_encode( $data['admin_image'] ) . '';
				$imgName=$data['admin_image_name'];
			?>
			<div class="span3">
				<a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage">
					<img src="<?php echo $img;?>" class="img-polaroid" width="180px" height="180px">
				</a>
			</div>
		
			<div class="span9">
				<?php
					echo "<p class='userName'>";
					echo $data['admin_firstName']." ".$data['admin_lastName']; 
					echo "</p>";
					echo "<p class='userHead'>";
					
					echo "<br>"."Email Address: ".$data['admin_emailId']."<br> ";
					echo "<br>"."Contact No.: ".$data['admin_contactNo']."<br> </p>";
				} } ?>
			</div>
	</div>

	<?php
		if(!isset($_GET['back']))
		{?>
		<div>
			<a href="index.php?page=user/edit_delete_user&action=edit&user=<?php echo base64_encode($user); ?>&row=<?php echo $id; ?>&back=edPro" class=" span1 btn btn-info" style="margin-left:170px">Edit</a>
		</div>
	<?php }
	?>
</div>