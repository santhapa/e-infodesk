<?php
	if($_SESSION['userType']==1)
	{//display the edit delete schedules page
?>

<?php
	if(isset($_GET['row']))
	{
		$id=base64_decode($_GET['row']);
	}

	if($_GET['action']=="delete")
	{	
		$modDbObj->deleteNotice($id);
	}

	if($_GET['action']=="edit")
	{
		$res=$modDbObj->specificNotice($id);
		$data=$funObj->fetchAssociate($res);
?>


<?php 

	if($formObj->num_errors >0)
    {?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
                                echo $formObj->error("formEmpty");
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>
<div class="content-header">
	<h2>Edit Notice</h2>
</div>

<div class="content-body">
		
	<form class="form-horizontal span11 updateNotice" method="POST" action="index.php?page=modules-process">
	
		<div class="control-group">
    		<label class="control-label" for="inTitle">Title:</label>
    		<div class="controls">
    			<input type="text" id="inTitle" name="notice_title" placeholder="Tomorrow is Holiday!" required 
    				value="<?php echo ($formObj->value("notice_title")) ? $formObj->value("notice_title") : $data['noticecol_title']; ?>">
    		</div>
  		</div>

  		<div class="control-group">
    		<label class="control-label" for="inBody">Description:</label>
    		<div class="controls" id="inBody">
          <textarea class="ckeditor" cols="80" id="editor1" name="notice_content" rows="10"><?php echo ($formObj->value("notice_content")) ? $formObj->value("notice_content") : $data['noticecol_content']; ?></textarea>
    			
    		</div>
  		</div>      
        
        <div class="control-group">
    		<label class="control-label" for="inAuthor">Author:</label>
    		<div class="controls">
    			<input type="text" id="inAuthor" name="notice_author" disabled value="<?php echo $_SESSION['userFName']; ?>">
    		</div>
  		</div>

  		<div class="control-group">
    		<label class="control-label" for="inDate">Date:</label>
    		<div class="controls">
    			<input type="text" id="inDate" name="notice_date" disabled value="<?php echo $funObj->currentDate(); ?>">
    		</div>
  		</div>

  		<div class="control-group">
    		<label class="control-label" for="inStatus">Status:</label>
    		<div class="controls">
    			<?php $status=($formObj->value("notice_status")) ? $formObj->value("notice_status") : $data['noticecol_status']; ?>
    			<select name="notice_status" id="inStatus">
            		<option selected disabled style="color: #aaa">Select status</option>
			   		<option value="true" 
			   			<?php 
			   				if($formObj->value("notice_status"))
			   					echo ($status=="true") ?' selected="selected"':'';
			   				else
			   					echo ($status==1) ?' selected="selected"':''; 
			   			?>>Active</option>
			   		<option value="false" 
			   			<?php 
			   				if($formObj->value("notice_status"))
			   					echo ($status=="false") ?' selected="selected"':'';
			   				else
			   					echo ($status==0) ?' selected="selected"':''; 
			   			?>>Inactive</option>
				</select>
    		</div>
  		</div>
		<input type="hidden" name="orgAuthor" value="<?php echo $_GET['author']; ?>">
      	<input type="hidden" name="noticeID" value="<?php echo $id; ?>"> 
		<input type="hidden" name="noticeUpdate" value="1">
		<div class="span3"></div><input type="submit" name="updateNotice" class="btn btn-info" value="Save">
		
	</form>	
   
</div>    
<?php } ?>


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

