<?php
	if($_SESSION['userType']==1 || $_SESSION['username']==$_GET['editor'])
	{//display the edit delete schedules page
?>

<?php
	if(isset($_GET['row']))
	{
		$id=base64_decode($_GET['row']);
	}

	if($_GET['action']=="delete")
	{	
		$modDbObj->deleteNote($id);
	}

	if($_GET['action']=="edit")
	{
		$res=$modDbObj->specificNote($id);
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
		
	<form class="form-horizontal span11 updateNote" method="POST" action="index.php?page=modules-process">
	
		<div class="control-group">
    		<label class="control-label" for="inTitle">Title:</label>
    		<div class="controls">
    			<input type="text" id="inTitle" name="note_title" placeholder="Note title!" required 
    				value="<?php echo ($formObj->value("note_title")) ? $formObj->value("note_title") : $data['notecol_title']; ?>">
    		</div>
  		</div>

  		<div class="control-group">
    		<label class="control-label" for="inBody">Body:</label>
    		<div class="controls" id="inBody">
          <textarea class="ckeditor" cols="80" id="editor1" name="note_body" rows="10"><?php echo $formObj->value("note_body") ? $formObj->value("note_body") : $data['notecol_body']; ?></textarea>
    			
    		</div>
  		</div>      
        
        <div class="control-group">
    		<label class="control-label" for="inAuthor">Author:</label>
    		<div class="controls">
    			<input type="text" id="inAuthor" name="note_author" disabled value="<?php echo $_SESSION['userFName']; ?>">
    		</div>
  		</div>

  		<div class="control-group">
    		<label class="control-label" for="inDate">Date:</label>
    		<div class="controls">
    			<input type="text" id="inDate" name="note_date" disabled value="<?php echo $funObj->currentDate(); ?>">
    		</div>
  		</div>

		  <input type="hidden" name="orgAuthor" value="<?php echo $_GET['author']; ?>">
      <input type="hidden" name="noteID" value="<?php echo $id; ?>"> 
		  <input type="hidden" name="noteUpdate" value="1">
		  <div class="span3"></div><input type="submit" name="updateNote" class="btn btn-info" value="Save">
      
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

