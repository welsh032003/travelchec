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
    <h1>Motor Vehicle Management</h1>
<a class="btn btn-primary"s href="add_motor_vehicle.php">Add Motor Vehicle</a><br><br><br>
<?php
if(!empty($_GET['message'])) {
$message = $_GET['message'];
 echo '<p class="message"> '.$message.'</p>';
}
?>
    <table id="customers">
  <tr>
    <th>No</th>
    <th>Employee</th>
    <th>Engine #</th>
    <th>Chassis #</th>
    <th>Make</th>
    <th>Model</th>
    <th>Year</th>
    <th>Doc</th>
    <th>Reassign <i class="fas fa-car"></i></th>
  </tr>

  <?php
  include 'inc/config.php';

  $select = "SELECT mv.status, mv.id as mvid, mv.model, md.id, md.name as modl, my.id, mv.year, my.year as yea, m.id, m.name, mv.emp_id, mv.EngineNo, e.id, e.first_name, e.last_name, mv.make, mv.model, mv.year, mv.ChassisNo
  FROM motor_vehicle mv
  JOIN employee_details e on mv.emp_id = e.id
  JOIN makes m on mv.make = m.id
  JOIN make_years my on mv.year = my.id
  JOIN models md on mv.model = md.id 
  ORDER BY mv.status ASC";

  $query = mysqli_query($conn, $select);
  if (mysqli_num_rows($query) != 0) {
    while ($row = mysqli_fetch_assoc($query)) { ?>
      <tr>
        <td><?php echo $row['mvid']; ?></td>
        <td><?php echo $row['last_name']; ?>, <?php echo $row['first_name']; ?></td>
        <td><?php echo $row['EngineNo']; ?></td>
        <td><?php echo $row['ChassisNo']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['modl']; ?></td>
        <td><?php echo $row['yea']; ?></td>
        <td>
          <?php
            $mvid = $row['mvid'];
            $select_doc = mysqli_query($conn, "SELECT * FROM motor_vehicle_document where mv_id = '$mvid' ");
            if (mysqli_num_rows($select_doc) != 0 ) { ?>
            <i style="color: green; text-align: center;" class="fas fa-check-circle"></i>
          <?php  } else { ?>
            <i style="color: red; text-align: center;" class="fas fa-times-circle"></i><a href="add_motor_vehicle_document.php?mvid=<?php echo $row['mvid']; ?>">Add</a>
          <?php  }

          ?>
        </td>
  
          <?php 
            if ($row['status'] == 'reassigned') { ?>
        <td style="background-color: green; color: white; font-weight: bold;"><p >Reassigned</p></td>   
          <?php  } else { ?>
        <td><a id="reassign_vehicle" data-id="<?php echo $row["id"] ?>"  href="javascript:void(0)"><i class="fas fa-redo t-ico"></i></a></td></td> 
          <?php }
          ?>

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
     
     
