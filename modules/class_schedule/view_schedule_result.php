<?php 

  if($formObj->num_success >0)
    {?>

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" data-delay="10">&times;</button>
            <center><strong><?php 
            
                                echo $formObj->success("search");
                                if($formObj->success("search"))
                                {?>
                                  <a href="index.php?page=class_schedule/view_schedule"><?php   echo "Search Again " ?></a><?php
                                }
                            ?>
            </strong></center>
        </div>
    <?php
    }
?>
<div class="content-header">
  <h2>
    <?php 
      if($_SESSION['userType']==2)
        echo "Class Schedules";
      else
        echo "Schedules Result";
    ?>
  </h2>
</div>

<div class="content-body">
  <?php 
 if($_SESSION['userType']==1 || $_SESSION['userType']==3)
 { 
  if($formObj->values)
  { ?>
  <div class="span10" style="padding-left: 150px">
  <table class="table table-striped" name="tblAllSchedules">
    <tr class="info">
      <td class="span4">Department</td>
      <td class="span2">Level</td>
      <td class="span2">Section</td>
      <td class="span2">Schedule</td>
    </tr> 

  <?php
    $ret=$modDbObj->getSchedule($formObj->value("schedule_viewType"), $formObj->value("schedule_dept"), $formObj->value("schedule_level"), $formObj->value("schedule_section"));
    while($data=$funObj->fetchArray($ret))
    {?>
        <tr>    
        <td><?php switch($data['schedulecol_department'])
                  {
                    case "BCT": echo"Deapartment of Computer";
                                break;
                    case "BEX": echo"Deapartment of Electronics";
                                break;
                    case "BCE": echo"Deapartment of Civil";
                                break;
                    case "CSIT": echo"Computer Science and Information Technology";
                                break;
                    case "BARCH": echo"Deapartment of Architecture";
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
<?php 
  } 
  else
    $funObj->redirect("index.php?page=class_schedule/view_schedule"); 
 }

 if($_SESSION['userType']==2)
 {

    $ret=$modDbObj->getStudentSchedule();
    while($data=$funObj->fetchArray($ret))
    {
      ?>
      <div class="classImage">
        <?php
          if(!$data['schedulecol_section'])
          {
            echo "";
          }
          else
          {
            echo "Section:"." ".$data['schedulecol_section'];
          }
          $img='data:image/jpeg;base64,' . base64_encode( $data['schedulecol_image'] ) . '';
        ?>  
    
        <img src="<?php echo $img;?>" class="img-polaroid">  
      </div>
      <?php
    }

 }
?>
</div>