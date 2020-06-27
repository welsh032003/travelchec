 <!--sidebar start-->
 
<div class="sidebar">
    <center>
       <img src="logo.jpg" class="profile_image" alt="">
       <?php
       if (isset($_SESSION['user']['role'])) { ?>
          <?php
            if ($_SESSION['user']['role'] == 'sysadmin') { ?>
                
                <h4>System Adminstrator</h4>
           <?php }elseif ($_SESSION['user']['role'] == 'accounts') { ?>
               <h4>Accounts Department</h4>
           <?php }elseif ($_SESSION['user']['role'] == 'hr') { ?>
                <h4>Human Resource </h4>
           <?php }
          ?>
       <?php } else { ?>
        <h4>Department Login</h4>
       <?php }
       ?>        
    </center>



    <?php
     if (isset($_SESSION['user']['role'])) { ?>
        <?php
          if ($_SESSION['user']['role'] == 'sysadmin') { ?>
            <!--Menu options for system admin-->
              <a href="adminpage.php"><i class="fa fa-desktop"></i><span>Dashboard</span></a>
              <a href="employee_management.php"><i class="fas fa-user"></i><span>Employees</span></a>
              <a href="user_management.php"><i class="fas fa-users"></i><span>User Management</span></a>
              <a href="#"><i class="fas fa-sliders-h"></i><span>Settings</span></a>              
         <?php }elseif ($_SESSION['user']['role'] == 'accounts') { ?>
           <!--Menu options for accounts department-->
              <a href="adminpage.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
              <a href="employee_management.php"><i class="fas fa-user"></i><span>Employee Details</span></a>
              <a href="report_management.php"><i class="fas fa-sticky-note"></i><span>Report</span></a>
              
         <?php }elseif ($_SESSION['user']['role'] == 'hr') { ?>
           <!--Menu option for human resource department-->
              <a href="adminpage.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
              <a href="motor_vechicle_management.php"><i class="fas fa-car"></i><span>Motor Vehicle</span></a>
              <a href="employee_details.php"><i class="fas fa-user"></i><span>Employee Details</span></a>
              <a href="report_management.php"><i class="fas fa-sticky-note"></i><span>Report</span></a>
         <?php }

        ?>
     <?php } else { ?>
        <!--sidebar end-->
        <a href="adminpage.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
        <a href="login.php?lpage=hr"><i class="far fa-user"></i><span>Human Resource</span></a>
        <a href="login.php?lpage=accounts"><i class="fas fa-file-invoice-dollar"></i><span>Accounts</span></a>
        <a href="login.php?lpage=sysadmin"><i class="fas fa-users-cog"></i><span>System Administrtion</span></a>
        <a href="#"><i class="fas fa-info-circle"></i><span>About</span></a>
        <a href="#"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
     <?php }
    ?>  



</div>
       <!--sidebar end-->