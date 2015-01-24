<div class="content-header">
	<h2>Search Results</h2>
</div>
<?php
	  if(isset($_POST['noteSearch']))
    {
      $searchString=strtolower($_POST['searchString']);
      
      $ret=$modDbObj->searchNote($searchString);
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
          <div data-toggle="collapse" data-target="#<?php echo $dat['notecol_id']; ?>">
            <label class="note-listHeading"><?php echo $dat['notecol_title']; ?></label>
          </div>
        
          <div id="<?php echo $dat['notecol_id']; ?>" class="collapse <?php if($numb==1) echo "in"; ?>">
            <div class="note-listBody">
              <?php echo $dat['notecol_body']; ?>
            </div>
            <p class="note-listFooter pull-right">
              Posted by <?php echo $dat['notecol_author']; ?> at <?php echo $dat['notecol_date']; ?>
              <?php
                if($_SESSION['userType']==1 || $_SESSION['username']==$dat['notecol_editor'])
                {?>
                  <a href="index.php?page=notice/edit_delete_notice&editor=<?php echo $data['notecol_editor']; ?>&author=<?php echo $dat['notecol_author']; ?>&action=edit&row=<?php echo base64_encode($dat['notecol_id']); ?>" class="btn btn-info"><span class="note-btn">Edit</span></a> 
                  <a href="index.php?page=notice/edit_delete_notice&editor=<?php echo $data['notecol_editor']; ?>&action=delete&row=<?php echo base64_encode($dat['notecol_id']); ?>" class="btn btn-info"><span class="note-btn">Delete</span></a>                
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