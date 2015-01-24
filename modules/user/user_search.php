<div class="content-header">
	<h2>Search Results</h2>
</div>
<?php
	if(isset($_POST['searchUserAdmin']) || isset($_POST['searchUserStudent']) || isset($_POST['searchUserStaff']))
    {
        $searchString=strtolower($_POST['userSearch']);
        $user=mysql_real_escape_string($_POST['user']);
    }

    if(isset($_GET['string']))
    {
        $user=base64_decode($_GET['user']);
        $searchString=base64_decode($_GET['string']);
    }
    {
        $ret=$modDbObj->searchUser($user, $searchString);
        $num=$funObj->totalRows($ret);

        if($num<=0)
        {
        	$noResult="Your query returns no result. Go back and ";
        	?>
        	<div class="alert alert-error">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
            	<center><strong><?php 
                                	echo $noResult;
                            	?>
                            	<a href="index.php?page=user/view_user_all">Search again!</a>
            	</strong></center>
        	</div>
        <?php }
        	
        else
        {
        	if($user==1)
        	{
        	?>
        		<div class="span11" style="padding-left: 80px">
          			<table class="table table-striped" name="tblAllAdmin">
            			<tr class="info">
              				<td class="span1">S.No.</td>
              				<td class="span2">Profile Picture</td>
              				<td class="span2">Username</td>
              				<td class="span3">Name</td>
              				<td class="span3">Email ID</td>
              				<td class="span2">Contact No.</td>
            			</tr>
            			<?php
             	 			$sn=0;  
              				while($data=$funObj->fetchArray($ret))
              				{?>
            
            			<tr>  
              				<td><?php
                  					$sn=1+$sn;
                  					echo $sn;
                				?>  
              				</td>
              				<td><?php $img='data:image/jpeg;base64,' . base64_encode( $data['admin_image'] ) . '';
                  						$imgName=$data['admin_image_name'];?>
                  				<a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage"><img src="<?php echo $img;?>" class="img-polaroid" width="70px" height="70px"></a> 
              				</td>
              				<td><?php echo $data['admin_username']; ?></td>
              				<td><?php echo $data['admin_firstName']." ".$data['admin_lastName']; ?></td>
              				<td><?php echo $data['admin_emailId']; ?></td>
              				<td><?php echo $data['admin_contactNo']; ?></td>
            			</tr>
            			<?php } ?>
          			</table>
        		</div> 

    	<?php } 
    		if($user==2)
    		{
    	?>		<div class="span11">
          			<table class="table table-striped" name="tblAllStudent">
            			<tr class="info">
              				<td>S.No.</td>
              				<td>Profile Picture</td>
              				<td>Username</td>
              				<td>Name</td>
              				<td>Roll No.</td>
              				<td>Email ID</td>
              				<td>Contact No.</td>
              				<td>Father Name</td>
              				<td>View Profile</td>
            			</tr>
            			<?php
              				$sn=0;  
              				while($data=$funObj->fetchArray($ret))
              			{?>
            
            			<tr>  
              				<td><?php
                  					$sn=1+$sn;
                  					echo $sn;
                				?>  
              				</td>
              				<td><?php $img='data:image/jpeg;base64,' . base64_encode( $data['stcol_image'] ) . '';
                  					$imgName=$data['stcol_image_name'];?>
                  				<a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage"><img src="<?php echo $img;?>" class="img-polaroid" width="70px" height="70px"></a> 
              				</td>
              				<td><?php echo $data['stcol_username']; ?></td>
              				<td><?php echo $data['stcol_firstName']." ".$data['stcol_lastName']; ?></td>
              				<td><?php echo $data['stcol_rollNo']; ?></td>
              				<td><?php echo $data['stcol_emailId']; ?></td>
              				<td><?php echo $data['stcol_contactNo']; ?></td>
              				<td><?php echo $data['stcol_fatherName']; ?></td>
              				<td><?php $user=base64_encode(2);
                        			$username=base64_encode( $data['stcol_username']);
                 				?>
                				<a href="index.php?page=user/user_profile&user=<?php echo $user; ?>&username=<?php echo $username ?>&back=sch&string=<?php echo base64_encode($searchString); ?>">View</a>
              				</td>
            			</tr>
            		<?php } ?>
          			</table>
        		</div> 

    	<?php }
    		if($user==3)
    		{
    	?>
    			<div class="span11">
          			<table class="table table-striped" name="tblAllStaff">
            			<tr class="info">
              				<td>S.No.</td>
              				<td>Profile Picture</td>
              				<td>Username</td>
              				<td>Name</td>
              				<td>Department</td>
              				<td>Email ID</td>
              				<td>Contact No.</td>
              				<td>Work Time</td>
              				<td>View Profile</td>
            			</tr>
            			<?php
              				$sn=0;  
              				while($data=$funObj->fetchArray($ret))
              				{?>
            
            			<tr>  
              				<td><?php
                  					$sn=1+$sn;
                  					echo $sn;
                				?>  
              				</td>
              				<td><?php $img='data:image/jpeg;base64,' . base64_encode( $data['stfcol_image'] ) . '';
                  					$imgName=$data['stfcol_image_name'];?>
                  				<a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage"><img src="<?php echo $img;?>" class="img-polaroid" width="70px" height="70px"></a> 
              				</td>
              				<td><?php echo $data['stfcol_username']; ?></td>
              				<td><?php echo $data['stfcol_firstName']." ".$data['stfcol_lastName']; ?></td>
              				<td><?php switch($data['stfcol_department'])
                        			{
                          				case "BCT": echo "Department of Computer Engineering <br>";
                                      				break;
                          				case "BEX": echo "Department of Electronics Engineering <br>";
                                      				break;
                          				case "BCE": echo "Department of Civil Engineering <br>";
                                      				break;
                          				case "BARCH": echo "Department of Architecture <br>";
                                        			break;
                          				case "CSIT":  echo "Computer Science and Information Technology <br>";
                                        			break;
                          				case "ACC": echo "Account Department<br>";
                                      				break;
                          				case "LIB": echo "Library Department<br>";
                                      				break;
                        			}
                  				?>
              				</td>
              				<td><?php echo $data['stfcol_emailId']; ?></td>
              				<td><?php echo $data['stfcol_contactNo']; ?></td>
              				<td><?php 
                    				switch($data['stfcol_workTime'])
                    				{
                      					case 0: echo "Part Time";
                              					break;
                      					case 1: echo "Full Time";
                              					break;
                    				}
                  				?>
              				</td>
             		 		<td><?php $user=base64_encode(3);
                        			$username=base64_encode( $data['stfcol_username']);
                 				?>
                				<a href="index.php?page=user/user_profile&user=<?php echo $user; ?>&username=<?php echo $username ?>&back=sch&string=<?php echo base64_encode($searchString); ?>">View</a>
              				</td>
            			</tr>
            		<?php } ?>
          		</table>
        	</div> 
    	<?php }
    	?>	

        <?php }
        	
    }

?>