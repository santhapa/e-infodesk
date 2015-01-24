
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="header">
          
    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
    <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="brand" href="index.php">e-InfoDesk
        <p class="brand-caption" color="#000">...sharing information!</p>
      </a>
 
    <!-- Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse collapse">

      <!-- .nav, .navbar-search, .navbar-form, etc -->
        <ul class="nav pull-right ">
          <li class="dropdown">
            <a href="#" data-hover="dropdown" data-delay="10" data-close-others="true"><i class=" icon-user icon-white"></i> Hello, <?php echo $_SESSION['userFName']; ?>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" >
            <!-- links -->
              <li><a href="index.php?page=user/user_profile ">View Profile</a></li>
              <li><a href="index.php?page=user/user_account">Account Settings</a></li>              
              <li><a href="process.php">Logout</a></li>
            </ul>
          </li>
        </ul>

        <ul class="nav">
          <li class=""><a href="index.php"><i class="icon-home icon-white"></i>&nbsp;Dashboard</a></li>
          <?php if($_SESSION['userType']==1){?>
          <li class="dropdown ">
            <a href= "index.php?page=user/user" data-hover="dropdown" data-delay="10" data-close-others="true" ><i class=" icon-user icon-white"></i>&nbsp;User  
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
            <!-- links -->
              <li><a href="index.php?page=user/view_user_all">View User</a></li>
              <li><a href="index.php?page=user/add_user">Add User</a></li>
              <li><a href="index.php?page=user/update_user">Update User</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="index.php?page=class_schedule/schedule" data-hover="dropdown" data-delay="10" data-close-others="true">
              <i class="  icon-list-alt icon-white"></i>&nbsp;Schedules
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
            <!-- links -->
              <li><a href="index.php?page=class_schedule/view_schedule">View Schedules</a></li>
              <li><a href="index.php?page=class_schedule/add_schedule">Add Schedules</a></li>
              <li><a href="index.php?page=class_schedule/update_schedule">Update Schedules</a></li>
            </ul>
          </li>
          <li class=""><a href="index.php?page=library/library"><i class="icon-book icon-white"></i>&nbsp;Library</a></li>
          <?php } ?>

          <li class=""><a href="index.php?page=notice/notice"><i class="icon-info-sign icon-white"></i>&nbsp;Notice</a></li>
          <?php if($_SESSION['userType']==1){?>
          <li class="dropdown ">
            <a href="#" data-hover="dropdown" data-delay="10" data-close-others="true">
              <i class="  icon-folder-close icon-white"></i>&nbsp;More
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
            <!-- links -->
              <li><a href="index.php?page=sms/sms">SMS</a></li>
              <li><a href="index.php?page=mail/mail">Mail Box</a></li>
              <li><a href="index.php?page=more/login_history">Login History</a></li> 
              <li><a href="index.php?page=note/note">Notes</a></li>
            </ul>
          </li><?php } ?>
          <?php
          if($_SESSION['userType']==2 || $_SESSION['userType']==3) 
          {?>
          <li class=""><a href="index.php?page=note/note"><i class="icon-folder-open icon-white"></i>&nbsp;Notes</a></li>
          <li class=""><a href="index.php?page=library/library"><i class="icon-book icon-white"></i>&nbsp;Library</a></li>

        <?php } ?>

        <?php
          if($_SESSION['userType']==3) 
          {?>
          <li class=""><a href="index.php?page=attend/attend"><i class="icon-file icon-white"></i>&nbsp;Attendance</a></li>

        <?php } ?>

        </ul>    


          
      </div> 
    </div>
  </div>
</div>