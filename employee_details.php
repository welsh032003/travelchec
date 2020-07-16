<?php include 'login_session.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
     <title>Travelchec Dashboard</title>
     <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link href="css/sweetalert.css" rel="stylesheet">
    
    <style type="text/css">
      .message{
        background-color: #57ff5e;
        width: auto;
        padding: 20px;
        font-weight: bold;
        border-radius: 12px;
      }
      .e-ico-t{
        color: blue;
        font-style: 25px;
        font-weight: bold;
      }
    </style>
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
  <div class="content-body"><br><br>
    <h1>Employee Details</h1>
    <a class="btn btn-primary"s href="add_employee.php">Add Employee</a><br><br><br>
<?php
if(!empty($_GET['message'])) {
$message = $_GET['message'];
 echo '<p class="message"> '.$message.'</p>';
}
?>
   <table id="customers">
  <tr>
    <th>Name</th>
    <th>DOB</th>
    <th>Email</th>
    <th>Address</th>
    <th>Edit</th>
    <th>Enable/Disable</th>
  </tr>

  <?php
  include 'inc/config.php';

  $select = "SELECT id, first_name, last_name, email, address1, parish, mobile, status, Date_Format(`dob`,'%b %e, %Y ') as datent FROM employee_details ORDER BY status ASC";
  $query = mysqli_query($conn, $select);
  if (mysqli_num_rows($query) != 0) {
    while ($row = mysqli_fetch_assoc($query)) { ?>
      <tr>
        <td><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></td>        
        <td><?php echo $row['datent']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['address1']; ?>, <?php echo $row['parish']; ?></td>
        <td><a href="edit_employee.php?eid=<?php echo $row['id']; ?>" style="cursor: pointer;" id="<?php echo $row['id']; ?>" ><i class="fas fa-user-edit t-ico"></i></a></td>
        <td style="text-align: center;">
          <?php
             if ($row['status'] == 'disabled') { ?>
          <a style="color: red;" id="enable_employee" data-id="<?php echo $row["id"] ?>"  href="javascript:void(0)"><i class="fas fa-user-times t-ico"></i></a>
          <?php  } else { ?>
           <a style="color: green;" id="disable_employee" data-id="<?php echo $row["id"] ?>"  href="javascript:void(0)"><i class="fas fa-user-check t-ico"></i></a>
          <?php }
          ?>
      </td>
      </tr>
   <?php }
    
  } else { ?>
   
    <tr>
      <td colspan="6"><p style="color: blue; font-size: 20px; font-weight: bold;">There is no employee in database...</p></td>
    </tr>
  <?php }



  ?>

  
</table> 



  </div>
</div>
<!--Main content area end--> 
 <script src="js/jquery/jquery.min.js"></script>
  <script src="js/jquery/jquery-migrate.min.js"></script>
  <script src="js/sweetalert.js"></script>
<script type="text/javascript">
  $(document).ready(function(){


    $(document).on('click', '#disable_employee', function(e){
      
      var empId = $(this).data('id');
      SwalDisable(empId);
      e.preventDefault();
    });


    function SwalDisable(empId){
   
    swal.fire({
      title: 'Disable Employee?',
      text: "Employee will be disabled.",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonText: 'No',
      cancelButtonColor: '#d33',
      confirmButtonText: 'YES',
      showLoaderOnConfirm: true,
        
      preConfirm: function() {
        return new Promise(function(resolve) {
             
           $.ajax({
            url: 'disable_employee.php',
            type: 'POST',
              data: 'disable='+empId,
              dataType: 'json'
           })
           .done(function(response){

            swal.fire('Employee Disabled!', response.message, response.status);
            
            setTimeout(function(){ location.reload(); }, 1000);
  
           })
           .fail(function(){
            swal.fire('Oops...', 'Something went wrong with ajax !', 'error', '1500');
           });
        });
        },
      allowOutsideClick: false        
    }); 
    
  }


      $(document).on('click', '#enable_employee', function(e){
      
      var empId = $(this).data('id');
      SwalEnable(empId);
      e.preventDefault();
    });


    function SwalEnable(empId){
   
    swal.fire({
      title: 'Enable Employee?',
      text: "Employee will be enabled.",
      type: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonText: 'No',
      cancelButtonColor: '#d33',
      confirmButtonText: 'YES',
      showLoaderOnConfirm: true,
        
      preConfirm: function() {
        return new Promise(function(resolve) {
             
           $.ajax({
            url: 'enable_employee.php',
            type: 'POST',
              data: 'enable='+empId,
              dataType: 'json'
           })
           .done(function(response){

            swal.fire('Employee Enabled!', response.message, response.status);
            
            setTimeout(function(){ location.reload(); }, 1000);
  
           })
           .fail(function(){
            swal.fire('Oops...', 'Something went wrong with ajax !', 'error', '1500');
           });
        });
        },
      allowOutsideClick: false        
    }); 
    
  }
});
</script>



</body>
</html>
     
     
