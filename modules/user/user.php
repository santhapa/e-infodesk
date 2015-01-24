
<?php
 	 if($formObj->num_success> 0)
	  {?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
                                echo $formObj->success("addUser");
                                if($formObj->success("addUser"))
                                {?>
									<a href="index.php?page=user/add_user"><?php   echo "Add more user" ?></a><?php
                                }
                            ?>
            </strong></center>
        </div>
        
        <?php
	  }
?>
     
<div class="content-header">
	<h2>User Actions</h2>
</div>

<div class="content-body">
	<div class="span4">
		<a href="index.php?page=user/view_user_all"> View User</a>
		<p> View all the users information that are stored in the database</p>
	</div>

	<div class="span4">
		<a href="index.php?page=user/add_user"> Add User</a>
		<p> Add the new users to the system</p>
	</div>

	<div class="span4">
		<a href="index.php?page=user/update_user"> Update User</a>
		<p> Edit or delete users information</p>
	</div>
    
    	

</div>	                
              
        