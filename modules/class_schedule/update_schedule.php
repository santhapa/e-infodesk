<?php
  if($_SESSION['userType']==1)
  {
?>

<?php 

  if($formObj->num_success >0)
    {?>

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" data-delay="10">&times;</button>
            <center><strong><?php 
            
                                echo $formObj->success("delete");
                                echo $formObj->success("edit");
                                
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>
<div class="content-header">
  <h2>Update Schedules</h2>
</div>

<div class="content-body">
  <?php
    $ret=$modDbObj->allSchedules();
    $dataNo=$funObj->totalRows($ret);
    if(!$dataNo)
    {?>
      <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <center><strong> No class schedules for now!</strong></center>
      </div>
  <?php } 
  else
  {
  ?>
  <div class="span11" style="padding-left: 100px">
  <table class="table table-striped" name="tblAllSchedules">
    <tr class="info">
      <td>S.No.</td>
      <td>Department</td>
      <td>Level</td>
      <td>Section</td>
      <td>Schedule</td>
      <td>Action</td>
    </tr> 

  <?php
    $num=0;
    while($data=$funObj->fetchArray($ret))
    {?>
        <tr> 
        <td><?php
                $num=1+$num;
                echo $num;
             ?>  
        </td>   
        <td><?php switch($data['schedulecol_department'])
                  {
                    case "BCT": echo "Department of Computer";
                                break;
                    case "BEX": echo "Department of Electronics";
                                break;
                    case "BCE": echo "Department of Civil";
                                break;
                    case "CSIT": echo "Computer Science and Information Technology";
                                break;
                    case "BARCH": echo "Department of Architecture";
                                break;
                  }
            ?>
        </td>
        <td><?php switch($data['schedulecol_level'])
                  {
                    case 1: echo "First";
                            break;
                    case 2: echo "Second";
                            break;
                    case 3: echo "Third";
                            break;
                    case 4: echo "Fourth";
                            break;
                    case 5: echo "Fifth";
                            break;

                  }  
            ?>
        </td>
        <td><?php echo $data['schedulecol_section'];?></td>
        <td><?php $img='data:image/jpeg;base64,' . base64_encode( $data['schedulecol_image'] ) . '';
                  $imgName=$data['schedulecol_image_name'];
           ?>
          <a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="scheduleImage">
          View</a> </td>
        <td><?php $id=base64_encode( $data['schedulecol_id'] ); ?>
            <a href="index.php?page=class_schedule/edit_delete_schedule&action=edit&row=<?php echo $id; ?>" class="btn btn-info">Edit</a>
                <a href="index.php?page=class_schedule/edit_delete_schedule&action=delete&row=<?php echo $id; ?>" class="btn btn-info">Delete</a>
              </div>
            </div>    
        </td>
         </tr>

         
    <?php }  ?>

  </table>
</div>
<?php } ?>
</div>

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