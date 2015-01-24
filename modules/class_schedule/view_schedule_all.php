<?php
  if($_SESSION['userType']==1||$_SESSION['userType']==3)
  {
?>
<div class="content-header">
  <h2>All Schedules</h2>
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
  <div class="span10" style="padding-left: 150px">
  <table class="table table-striped" name="tblAllSchedules">
    <tr class="info">
      <td class="span1">S.No.</td>
      <td class="span4">Department</td>
      <td class="span2">Level</td>
      <td class="span2">Section</td>
      <td class="span2">Schedule</td>
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
         </tr>

         
    <?php } ?>

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