<div class="content-header">
	<h2>Search Results</h2>
</div>
<?php
	  if(isset($_POST['searchNotice']))
    {
      $searchString=strtolower($_POST['searchString']);
      $status=mysql_real_escape_string($_POST['status']);
      
      $ret=$modDbObj->searchNotice($status, $searchString);
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
                         	<a href="index.php?page=notice/notice">Search again!</a>
          </strong></center>
        </div>
      <?php }
        	
      else
      {?>
        <?php
        $numb=0;
        while($dat=$funObj->fetchArray($ret))
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
        <?php 
        } //while close 
      }//else close
        	
    }//isset if close

    else
    {?>
      <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <center><strong>Sorry, We are unable to process your request!</strong></center>
      </div>
    <?php
    }
?>