<?php 

  if($formObj->num_success >0)
    {?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong><?php 
                                echo $formObj->success("addNote");
                                echo $formObj->success("updateNote");
                                echo $formObj->success("delete");
                                if($formObj->success("addNote"))
                                {?>
                  <a href="index.php?page=note/add_note"><?php   echo "Add more notes!" ?></a><?php
                                }
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>


<div class="content-header">
	<h2>Notes</h2>
</div>

<div class="content-body">

	<div class="note "> 
    <!-- Header bar-->
    <form class="form-inline span10 input-append" method="POST" action="index.php?page=note/note_search">
     	<input type="text" placeholder="What is your question?" name="searchString" class="span11" required>
     	<input type="hidden" name="noteSearch" value="1">
     	<button class="btn btn-info" type="submit" name="searchNote"><i class="icon-search icon-white"></i></button>
    </form>
    
    <a href="index.php?page=note/add_note" class="btn btn-info" type="submit" name="searchNote">
    	<span class="note-btn"> Post Notes</span>
    </a>
    <!--Header bar closes-->
  </div>

    <div class="note-body">

    <?php
    $ret=$modDbObj->allNote();
    $dataNo=$funObj->totalRows($ret);
    $num=0;
    if(!$dataNo)
    {?>
      <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <center><strong> No any notes are published for now!</strong></center>
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
        <div data-toggle="collapse" data-target="#<?php echo $data['notecol_id']; ?>">
          <label class="note-listHeading"><?php echo $data['notecol_title']; ?></label>
        </div>
        
        <div id="<?php echo $data['notecol_id']; ?>" class="collapse <?php if($num==1) echo "in"; ?>">
          <div class="note-listBody">
            <?php echo $data['notecol_body']; ?>
          </div><br>
          <p class="note-listFooter pull-right">
            Posted by <?php echo $data['notecol_author']; ?> at <?php echo $data['notecol_date']; ?>
            <?php
              if($_SESSION['userType']==1 || $_SESSION['username']== $data['notecol_editor'])
              {?>
                <a href="index.php?page=note/edit_delete_note&editor=<?php echo $data['notecol_editor']; ?>&author=<?php echo $data['notecol_author']; ?>&action=edit&row=<?php echo base64_encode($data['notecol_id']); ?>" class="btn btn-info"><span class="note-btn">Edit</span></a> 
                <a href="index.php?page=note/edit_delete_note&editor=<?php echo $data['notecol_editor']; ?>&action=delete&row=<?php echo base64_encode($data['notecol_id']); ?>" class="btn btn-info"><span class="note-btn">Delete</span></a>                
            <?php  }
            ?>
          </p> 
<!--
          <div class="note-listFooter comment pull-left">
            <label data-target="#comment-box" data-toggle="modal"><span class="note-comment">Write Comment</span> </label>
            <div id="comment-box" class="modal note-comment-box hide" >
              
              <textarea row="2" class="span12"></textarea>
            </div>

          </div>
        </div>
  -->
      <?php } 
    }
  ?>
  </div>

</div>


<?php
  //include("modules/modules-js.php"); 
?>