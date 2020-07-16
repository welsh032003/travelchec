<?php include 'login_session.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
     <title>Travelchec Dashboard</title>
     <link rel="stylesheet" href="style.css">
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
  <div class="content-body"><br><br>
    <h1>Motor Vehicle Documents</h1>
<br><br><br>
<?php
if(!empty($_GET['message'])) {
$message = $_GET['message'];
 echo '<p class="message"> '.$message.'</p>';
}
?>
    <table id="customers">
  <tr>
    <th>Employee</th>
    <th>License #</th>
    <th>License Expire</th>
    <th>Reg. Expire</th>
    <th>Insurance Expire</th>
    <th>Fitness Expire</th>
  </tr>

  <?php
  include 'inc/config.php';

  $select = "SELECT mvd.emp_id, mvd.licenseno, mvd.licenseexpire, mvd.regexpire, mvd.insuranceexpire, mvd.fitnessexpire, e.id, e.first_name, e.last_name
  FROM motor_vehicle_document mvd
  left JOIN employee_details e ON mvd.id = e.id ";

echo "$select";
  $query = mysqli_query($conn, $select);
  if (mysqli_num_rows($query) != 0) {
    while ($row = mysqli_fetch_assoc($query)) { ?>
      <tr>
        <td><?php echo $row['last_name']; ?>, <?php echo $row['first_name']; ?></td>
        <td><?php echo $row['licenseno']; ?></td>
        <td><?php echo $row['licenseexpire']; ?></td>
        <td><?php echo $row['regexpire']; ?></td>
        <td><?php echo $row['insuranceexpire']; ?></td>
        <td><?php echo $row['fitnessexpire']; ?></td>

     </tr>
   <?php }
    
  } else { ?>
    <tr>
      <td colspan="8"><p style="color: blue; font-size: 20px; font-weight: bold;">No motor vehicle is assigned</p></td>
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


    $(document).on('click', '#reassign_vehicle', function(e){
      
      var mvId = $(this).data('id');
      SwalDelete(mvId);
      e.preventDefault();
    });


    function SwalDelete(mvId){
   
    swal.fire({
      title: 'Reassign Vehicle',
      text: "Are you sure you want to reassign vehicle?",
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
            url: 'reassign_motorvehicle.php',
            type: 'POST',
              data: 'reassign='+mvId,
              dataType: 'json'
           })
           .done(function(response){

            swal.fire('Motor Vehicle Reassign!', response.message, response.status);
            
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
     
     
