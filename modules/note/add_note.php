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
	<h2>Add Notes</h2>
</div>

<div class="content-body">
	<form class="form-horizontal span11 addNote" method="POST" action="index.php?page=modules-process">
  
    <div class="control-group">
        <label class="control-label" for="inTitle">Title:</label>
        <div class="controls">
          <input type="text" id="inTitle" name="note_title" placeholder="Note title!" required value="<?php echo $formObj->value("note_title"); ?>">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="inBody">Body:</label>
        <div class="controls" id="inBody">
          <textarea class="ckeditor" cols="80" id="editor1" name="note_body" rows="10"></textarea>
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

    <input type="hidden" name="noteAdd" value="1">
    <div class="span3"></div><input type="submit" name="addNote" class="btn btn-info" value="Post">
    
  </form>
</div>	