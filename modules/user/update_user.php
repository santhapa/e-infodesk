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
  <h2>All Users</h2>
</div>

<div class="content-body">
  <div class="viewTab">
    <ul class="nav nav-tabs" id="myTab">
      <li class="active"><a href="#admin" data-toggle="tab">Admin</a></li>
      <li><a href="#student" data-toggle="tab">Student</a></li>
      <li><a href="#staff" data-toggle="tab">Staff</a></li>
    </ul>

    <div class="tab-content">
      <!--Admin view user tab pane-->
      <div class="tab-pane active" id="admin">
        <?php
          $ret=$modDbObj->getUser("1");
          $dataNo=$funObj->totalRows($ret);
          if(!$dataNo)
          {?>
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong> No Users!</strong></center>
          </div>
          <?php } 
          else
          {
        ?>
        <div class="span11" style="padding-left: 80px">
          <table class="table table-striped" name="tblAllAdmin">
            <tr class="info">
              <td >S.No.</td>
              <td >Profile Picture</td>
              <td >Username</td>
              <td >Name</td>
              <td >Email ID</td>
              <td >Contact No.</td>
              <td >Action</td>
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
              <td><?php $img='data:image/jpeg;base64,' . base64_encode( $data['admin_image'] ) . '';
                  $imgName=$data['admin_image_name'];?>
                  <a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage"><img src="<?php echo $img;?>" class="img-polaroid" width="70px" height="70px"></a> 
              </td>
              <td><?php echo $data['admin_username']; ?></td>
              <td><?php echo $data['admin_firstName']." ".$data['admin_lastName']; ?></td>
              <td><?php echo $data['admin_emailId']; ?></td>
              <td><?php echo $data['admin_contactNo']; ?></td>
              <td><?php $id=base64_encode( $data['admin_id'] ); 
                        $user=base64_encode(1);
                  ?>
                    <a href="index.php?page=user/edit_delete_user&action=edit&row=<?php echo $id; ?>&user=<?php echo $user; ?>" class="btn btn-info">Edit</a>
                    <a href="index.php?page=user/edit_delete_user&action=delete&row=<?php echo $id; ?>&user=<?php echo $user; ?>" class="btn btn-info">Delete</a>
              </td>
            </tr>
            <?php } ?>
          </table>
        </div> 
        <?php } ?>
      </div>

      <!--Student view user tab pane-->
      <div class="tab-pane" id="student">
        <?php
          $ret=$modDbObj->getUser("2");
          $dataNo=$funObj->totalRows($ret);
          if(!$dataNo)
          {?>
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong> No Users!</strong></center>
          </div>
          <?php } 
          else
          {
        ?>
        <div class="span12">
          <table class="table table-striped" name="tblAllStudent">
            <tr class="info">
              <td >S.No.</td>
              <td>Profile Picture</td>
              <td>Username</td>
              <td>Name</td>
              <td>Roll No.</td>
              <td>Email ID</td>
              <td>Contact No.</td>
              <td>Father Name</td>
              <td>View Profile</td>
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
              <td><?php $img='data:image/jpeg;base64,' . base64_encode( $data['stcol_image'] ) . '';
                  $imgName=$data['stcol_image_name'];?>
                  <a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage"><img src="<?php echo $img;?>" class="img-polaroid" width="70px" height="70px"></a> 
              </td>
              <td><?php echo $data['stcol_username']; ?></td>
              <td><?php echo $data['stcol_firstName']." ".$data['stcol_lastName']; ?></td>
              <td><?php echo $data['stcol_rollNo']; ?></td>
              <td><?php echo $data['stcol_emailId']; ?></td>
              <td><?php echo $data['stcol_contactNo']; ?></td>
              <td><?php echo $data['stcol_fatherName']; ?></td>
              <td><?php $user=base64_encode(2);
                        $username=base64_encode( $data['stcol_username']);
                 ?>
                <a href="index.php?page=user/user_profile&user=<?php echo $user; ?>&username=<?php echo $username ?>&back=up">View</a>
              </td>
              <td><?php $id=base64_encode( $data['stcol_id'] ); ?>
                    <a href="index.php?page=user/edit_delete_user&action=edit&row=<?php echo $id; ?>&user=<?php echo $user; ?>" class="btn btn-info">Edit</a>
                    <a href="index.php?page=user/edit_delete_user&action=delete&row=<?php echo $id; ?>&user=<?php echo $user; ?>" class="btn btn-info">Delete</a>
              </td>
            </tr>
            <?php } ?>
          </table>
        </div> 
        <?php } ?>
      </div>

      <!--Staff view user tab pane-->

      <div class="tab-pane" id="staff">
        <?php
          $ret=$modDbObj->getUser("3");
          $dataNo=$funObj->totalRows($ret);
          if(!$dataNo)
          {?>
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <center><strong> No Users!</strong></center>
          </div>
          <?php } 
          else
          {
        ?>
        <div class="span12">
          <table class="table table-striped" name="tblAllStaff">
            <tr class="info">
              <td>S.No.</td>
              <td>Profile Picture</td>
              <td>Username</td>
              <td>Name</td>
              <td>Department</td>
              <td>Email ID</td>
              <td>Contact No.</td>
              <td>Work Time</td>
              <td>View Profile</td>
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
              <td><?php $img='data:image/jpeg;base64,' . base64_encode( $data['stfcol_image'] ) . '';
                  $imgName=$data['stfcol_image_name'];?>
                  <a href="<?php echo $img; ?>" data-lightbox="<?php echo $img; ?>" title="<?php echo $imgName; ?>" class="userImage"><img src="<?php echo $img;?>" class="img-polaroid" width="70px" height="70px"></a> 
              </td>
              <td><?php echo $data['stfcol_username']; ?></td>
              <td><?php echo $data['stfcol_firstName']." ".$data['stfcol_lastName']; ?></td>
              <td><?php switch($data['stfcol_department'])
                        {
                          case "BCT": echo "Department of Computer Engineering <br>";
                                      break;
                          case "BEX": echo "Department of Electronics Engineering <br>";
                                      break;
                          case "BCE": echo "Department of Civil Engineering <br>";
                                      break;
                          case "BARCH": echo "Department of Architecture <br>";
                                        break;
                          case "CSIT":  echo "Computer Science and Information Technology <br>";
                                        break;
                          case "ACC": echo "Account Department<br>";
                                      break;
                          case "LIB": echo "Library Department<br>";
                                      break;
                        }
                  ?>
              </td>
              <td><?php echo $data['stfcol_emailId']; ?></td>
              <td><?php echo $data['stfcol_contactNo']; ?></td>
              <td><?php 
                    switch($data['stfcol_workTime'])
                    {
                      case 0: echo "Part Time";
                              break;
                      case 1: echo "Full Time";
                              break;
                    }
                  ?>
              </td>
              <td><?php $user=base64_encode(3);
                        $username=base64_encode( $data['stfcol_username']);
                 ?>
                <a href="index.php?page=user/user_profile&user=<?php echo $user; ?>&username=<?php echo $username ?>&back=up">View</a>
              </td>
              <td><?php $id=base64_encode( $data['stfcol_id'] );
               ?>

                    <a href="index.php?page=user/edit_delete_user&action=edit&row=<?php echo $id; ?>&user=<?php echo $user; ?>" class="btn btn-info">Edit</a>&nbsp;/&nbsp;
                    <a href="index.php?page=user/edit_delete_user&action=delete&row=<?php echo $id; ?>&user=<?php echo $user; ?>" class="btn btn-info">Delete</a>    
              </td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <?php } ?> 
      </div>
    </div>
  </div>
 
<script>
  $(function () {
    $('#myTab a:last').tab('show');
  })
</script>
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