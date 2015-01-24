<?php
  if($_SESSION['userType']==1)
  {

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
        <div class="input-append offset8"> 
          <form class="form-inline" method="POST" action="index.php?page=user/user_search">
            <input type="text" placeholder="Search" name="userSearch" required>
            <input type="hidden" name="user" value="1">
            <button class="btn btn-info" type="submit" name="searchUserAdmin"><i class="icon-search icon-white"></i></button>
          </form>  
        </div>
        
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
              <td class="span1">S.No.</td>
              <td class="span2">Profile Picture</td>
              <td class="span2">Username</td>
              <td class="span3">Name</td>
              <td class="span3">Email ID</td>
              <td class="span2">Contact No.</td>
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
            </tr>
            <?php } ?>
          </table>
        </div>
        <?php } ?> 
      </div>

      <!--Student view user tab pane-->
      <div class="tab-pane" id="student">
        <div class="input-append offset8">
          <form class="form-inline" method="POST" action="index.php?page=user/user_search">
            <input type="text" placeholder="Search" name="userSearch" required>
            <input type="hidden" name="user" value="2">
            <button class="btn btn-info" type="submit" name="searchUserStudent"><i class="icon-search icon-white"></i></button>
          </form>  
        </div>
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
        <div class="span11">
          <table class="table table-striped" name="tblAllStudent">
            <tr class="info">
              <td>S.No.</td>
              <td>Profile Picture</td>
              <td>Username</td>
              <td>Name</td>
              <td>Roll No.</td>
              <td>Email ID</td>
              <td>Contact No.</td>
              <td>Father Name</td>
              <td>View Profile</td>
            </tr>
            <?php
              $ret=$modDbObj->getUser("2"); 
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
                <a href="index.php?page=user/user_profile&user=<?php echo $user; ?>&username=<?php echo $username ?>&back=vill">View</a>
              </td>
            </tr>
            <?php } ?>
          </table>
        </div> 
        <?php } ?>
      </div>

      <!--Staff view user tab pane-->

      <div class="tab-pane " id="staff">
        <div class="input-append offset8">
          <form class="form-inline" method="POST" action="index.php?page=user/user_search">
            <input type="text" placeholder="Search" name="userSearch" required>
            <input type="hidden" name="user" value="3">
            <button class="btn btn-info" type="submit" name="searchUserStaff"><i class="icon-search icon-white"></i></button>
          </form>  
        </div>
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
        <div class="span11">
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
            </tr>
            <?php
              $ret=$modDbObj->getUser("3"); 
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
                <a href="index.php?page=user/user_profile&user=<?php echo $user; ?>&username=<?php echo $username ?>&back=vill">View</a>
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