<?php 

	if($formObj->num_success >0)
    {?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
                                echo $formObj->success("addNotice");
                                echo $formObj->success("updateNotice");
                                echo $formObj->success("delete");
                                if($formObj->success("addNotice"))
                                {?>
									<a href="index.php?page=notice/add_notice"><?php   echo "Add more notices!" ?></a><?php
                                }
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>
<div class="content-header">
	<h2>Notices</h2>
</div>

<div class="content-body">
  <?php 
  if($_SESSION['userType']==1)
  {?> 
    <div class="pull-right">
      <a href="index.php?page=notice/add_notice" class="btn btn-info"><span class="notice-btn">Post Notice!</span></a>
    </div><br><br>

    <ul class="nav nav-tabs" id="noticeTab">
      <li class="active"><a href="#activeNotice" data-toggle="tab"><span class="notice-tab">Active</span></a></li>
      <li><a href="#inactiveNotice" data-toggle="tab"><span class="notice-tab">Inactive</span></a></li>
    </ul>

    <div class="tab-content">
      <!--Active news and notices tab pane-->
      <div class="tab-pane active" id="activeNotice">
  <?php } //closing admin section such that admin views the active notice on active tab where as others as ususal.  
  ?>
    <div class="input-append pull-right"> 
      <form class="form-inline" method="POST" action="index.php?page=notice/notice_search">
        <input type="text" placeholder="Search" name="searchString" class="input-medium" required>
        <input type="hidden" name="status" value="1">
        <button class="btn btn-info" type="submit" name="searchNotice"><i class="icon-search icon-white"></i></button>
      </form>  
    </div><br><br>

  <?php
    $ret=$modDbObj->allActiveNotice();
    $dataNo=$funObj->totalRows($ret);
    $num=0;
    if(!$dataNo)
    {?>
      <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <center><strong> No any news and notices for now!</strong></center>
     </div>
  <?php } 
    else
    {
  ?>

  	<?php
    	while($data=$funObj->fetchArray($ret))
      { 
        $num=$num+1;
      ?> 		
  			<div data-toggle="collapse" data-target="#<?php echo $data['noticecol_id']; ?>">
        	<label class="notice-heading"><?php echo $data['noticecol_title']; ?></label>
      	</div>
    		
        <div id="<?php echo $data['noticecol_id']; ?>" class="collapse <?php if($num==1) echo "in"; ?>">
      		<div class="notice-body">
        		<?php echo $data['noticecol_content']; ?>
      	  </div>
          <p class="notice-footer pull-right">
            Posted by <?php echo $data['noticecol_author']; ?> at <?php echo $data['noticecol_date']; ?>
            <?php
              if($_SESSION['userType']==1 )
              {?>
                <a href="index.php?page=notice/edit_delete_notice&author=<?php echo $data['noticecol_author']; ?>&action=edit&row=<?php echo base64_encode($data['noticecol_id']); ?>" class="btn btn-info"><span class="notice-btn">Edit</span></a> 
                <a href="index.php?page=notice/edit_delete_notice&action=delete&row=<?php echo base64_encode($data['noticecol_id']); ?>" class="btn btn-info"><span class="notice-btn">Delete</span></a>                
            <?php  }
            ?>
          </p> 
    		</div>
  	  <?php	}	
    }
  ?>

  <?php //displaying inactive news for admin on inactive tab but others can't view it
    if($_SESSION['userType']==1)
    {?>
    </div>

    <div class="tab-pane" id="inactiveNotice">

      <div class="input-append pull-right"> 
        <form class="form-inline" method="POST" action="index.php?page=notice/notice_search">
          <input type="text" placeholder="Search" name="searchString" class="input-medium" required>
          <input type="hidden" name="status" value="0">
          <button class="btn btn-info" type="submit" name="searchNotice"><i class="icon-search icon-white"></i></button>
        </form>  
      </div><br><br>
      
      <?php
        $retval=$modDbObj->allInactiveNotice();
        $dataNum=$funObj->totalRows($retval);
        $numb=0;
        if(!$dataNum)
        {?>
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <center><strong> No any news and notices for now!</strong></center>
          </div>
      <?php } 
      else
      {
      ?>

      <?php
        while($dat=$funObj->fetchArray($retval))
        { 
          $numb=$numb+1;
      ?>    
          <div data-toggle="collapse" data-target="#<?php echo $dat['noticecol_id']; ?>">
            <label class="notice-heading"><?php echo $dat['noticecol_title']; ?></label>
          </div>
        
          <div id="<?php echo $dat['noticecol_id']; ?>" class="collapse <?php if($numb==1) echo "in"; ?>">
            <div class="notice-body">
              <?php echo $dat['noticecol_content']; ?>
            </div>
            <p class="notice-footer pull-right">
              Posted by <?php echo $dat['noticecol_author']; ?> at <?php echo $dat['noticecol_date']; ?>
              <?php
                if($_SESSION['userType']==1 )
                {?>
                  <a href="index.php?page=notice/edit_delete_notice&author=<?php echo $dat['noticecol_author']; ?>&action=edit&row=<?php echo base64_encode($dat['noticecol_id']); ?>" class="btn btn-info"><span class="notice-btn">Edit</span></a> 
                  <a href="index.php?page=notice/edit_delete_notice&action=delete&row=<?php echo base64_encode($dat['noticecol_id']); ?>" class="btn btn-info"><span class="notice-btn">Delete</span></a>                
              <?php  }
              ?>
            </p> 
          </div>
        <?php } 
        }
      ?>
    </div>
  </div>  
  <?php  }
  ?>
</div>	

<script>
  $(function () {
    $('#noticeTab a:last').tab('show');
  })
</script>