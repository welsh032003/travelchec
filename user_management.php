<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
     <title>Travelchec Dashboard</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="css/modal.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
     <link href="css/sweetalert.css" rel="stylesheet">
 </head>   
<body>
    
    <input type="checkbox" id="check">


<!--header area start-->    
<header>
    <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
        <h3>Travel<span>Chec</span></h3>
    </div>
    <div class="right_area">
  <?php
     if (isset($_SESSION['user']['role'])) { ?>
        <a href="logout.php" class="logout_btn">Logout</a>
     <?php } else { ?>
     
     <?php }
  ?>
    </div>
</header>
<!--header area end-->


<!--Sidebar included-->   
<?php include 'sidebar.php'; ?>

<!--Main content area started--> 
<div class="content">
      <?php
     if (isset($_SESSION['user']['role'])) { ?>
        <?php
          if ($_SESSION['user']['role'] == 'sysadmin') { ?>
            <!--Dashboard card if user is system admin-->
  <div class="content-body"><br><br>
    <h1>User Management</h1>

<div class="modal-container">
  <input id="modal-toggle" type="checkbox">
  <button class="btn btn-primary">Add Users</button>
  <div class="modal-backdrop">
    <div class="modal-content">
      <label class="modal-close" for="modal-toggle">x</label>
      <h2>Add User</h2>
      <hr />    
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" >
        <span id="username-info" class="info"></span><br>

        <label for="uemail">Email:</label>
        <input type="text" id="uemail" name="uemail" >
        <span id="email-info" class="info"></span> <br>

        <label for="role">User Role</label>
        <select id="role" name="role">
          <option value="">Select role</option>
          <option value="hr">Human Resource Department</option>
          <option value="accounts">Accounts Department</option>
          <option value="sysadmin">System Adminstrator</option>
        </select>
        <span id="role-info" class="info"></span><br>

        <input type="hidden" id="upassword" name="upassword" value="password" >
      
        <button name="submit" class="btn btn-primary" onClick="addUser();">Save User</button>      
      </div>
  </div>
</div>



<table id="customers">
  <tr>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
    <th>Status</th>
  </tr>

  <?php
  include 'inc/config.php';

  $select = "SELECT * FROM user_accounts ";
  $query = mysqli_query($conn, $select);
  if (mysqli_num_rows($query) != 0) {
    while ($row = mysqli_fetch_assoc($query)) { ?>
      <tr>
        <td><?php echo $row['UserName']; ?></td>
        <td><?php echo $row['UserEmail']; ?></td>
        <td><?php echo $row['UserType']; ?></td>
        <td><a style="cursor: pointer;" class="tooltip" id="<?php echo $row['id']; ?>" ><i class="fas fa-user-edit t-ico"></i><span class="tooltiptext">Edit <?php echo $row['UserName']; ?></span></a></td>

        

        <?php
        if ($row['UserStatus'] == 'active') { ?>
          <td><a style="cursor: pointer;" class="tooltip" ><i style="color: #33ff33;" class="fas fa-user-plus t-ico"></i><span class="tooltiptext">Disable <?php echo $row['UserName']; ?></span></a></td>
         
        <?php } elseif ($row['UserStatus'] == 'deactive') { ?>
          <td><a style="cursor: pointer;" class="tooltip" ><i style="color: red;" class="fas fa-user-times t-ico"></i><span class="tooltiptext">Enable <?php echo $row['UserName']; ?></span></a></td>

        <?php } else {

        }


        ?>




      </tr>
   <?php }
    
  } else {
    echo "There is no user to display at this time..";
  }



  ?>

  
</table>

  </div>
           
         <?php }elseif ($_SESSION['user']['role'] == 'accounts') { ?>
           <!-- Dashboard card if user is accounts department-->

         <?php }elseif ($_SESSION['user']['role'] == 'hr') { ?>
           <!--Dashboard card if user is human resource department-->

         <?php }

        ?>
     <?php } else { ?>
        <!--Remove content body if user is not login-->

     <?php }
    ?> 

</div>
<!--Main content area end--> 







  <script type="text/javascript" src="js/modal.js"></script>
  <script src="js/jquery/jquery.min.js"></script>
  <script src="js/jquery/jquery-migrate.min.js"></script>
  <script src="js/sweetalert.js"></script>
</body>
</html>
     
     
