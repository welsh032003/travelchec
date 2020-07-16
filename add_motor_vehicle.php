<?php include 'emp_login_session.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
     <title>Travelchec Dashboard</title>
     <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-form.css">
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
     if (isset($_SESSION['employee']['id'])) { ?>
        <a href="logout.php" class="logout_btn">Logout</a>
     <?php } else { ?>
     
     <?php }
  ?>
    </div>
</header>
<!--header area end-->


<!--Sidebar included-->   
<?php include 'sidebar_emp.php'; ?>



<!--Main content area started--> 
<div class="content">
  <div class="content-body"><br><br>
    <h1>Motor Vehicle Information</h1>
<?php
include 'inc/config.php';


if (isset($_POST['submit'])) {
    
    $employee =mysqli_real_escape_string($conn,$_SESSION['employee']['id']);
    $engineno =mysqli_real_escape_string($conn,$_POST['engineno']);
    $make =mysqli_real_escape_string($conn,$_POST['make']);
    $year =mysqli_real_escape_string($conn,$_POST['year']);
    $model =mysqli_real_escape_string($conn,$_POST['model']);
    $chassisno =mysqli_real_escape_string($conn,$_POST['chassisno']);



    $select = "SELECT COUNT(*) AS total FROM motor_vehicle WHERE emp_id = '".$_POST["employee"]."' AND status != 'reassigned' ";
    $query = mysqli_query($conn, $select);
    $values = mysqli_fetch_assoc($query); 
    $num_rows = $values['total']; 
   //$emp_status = $values['status'];

    if ($num_rows == '1' ) {

       header("Location: add_motor_vehicle.php?message=Employee already assigned a vehicle");  
    }else {


    $insert = "INSERT INTO `motor_vehicle` (`emp_id`, `EngineNo`, `make`, `year`, `model`, `ChassisNo`) VALUES ('$employee', '$engineno', '$make', '$year', '$model', '$chassisno') ";
    $inser_query = mysqli_query($conn, $insert); 
    $last_id = mysqli_insert_id($conn);
       header("Location: employee_dashboard.php"); 
    
  }
}

mysqli_close($conn);
?>

<?php 
    // Include the database config file 
    include_once 'inc/config.php'; 
     
    // Fetch all the car make 
    $query = "SELECT * FROM makes ORDER BY name ASC"; 
    $result = $db->query($query); 

    // Fetch all the employee that were not assigned a car
    $query1 = "SELECT * FROM employee_details ORDER BY last_name ASC"; 
    $result1 = $db->query($query1); 
?>

    <?php
    if(!empty($_GET['message'])) {
    $message = $_GET['message'];
     echo '<p class="message"> '.$message.'</p>';
    }
    ?>

<form id="example-form" action="" method="post" class="form-horizontal plvr">



    <div class="col-25">
        <label>EngineNo:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;'  maxlength="10" type="text" name="engineno" required>
    </div>
    <div class="col-25">
        <label>Make:</label>
    </div>
    <div class="col-75">
    <select style='width:400px;' id="make" name="make" required>
        <option value="">Select Make</option>
  <?php 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Make not available</option>'; 
    } 
    ?>
    </select>
    </div>
    <div class="col-25">
        <label>Year:</label>
    </div>
    <div class="col-75">
    <select style='width:400px;' id="year" name="year" required>
        <option value="">Select Year</option>
    </select>
    </div>
    <div class="col-25">
        <label>Model:</label>
    </div>
    <div class="col-75">
    <select style='width:400px;' id="model" name="model" required>
        <option value="">Select Model</option>
    </select>
    </div>
    <div class="col-25">
        <label>Chassis No:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: uppercase;' maxlength="10" type="text" name="chassisno" required>
    </div>

 

    <div class="col-25">
        <input class="btn btn-primary" type="submit" value="Save Employee" name="submit">
    </div>

</form>


    



  </div>
</div>
<!--Main content area end--> 
  <script src="js/jquery/jquery.min.js"></script>
  <script src="js/jquery/jquery-migrate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
<script>
$(document).ready(function(){
    $('#make').on('change', function(){
        var makeID = $(this).val();
        if(makeID){
            $.ajax({
                type:'POST',
                url:'load_car.php',
                data:'make_id='+makeID,
                success:function(html){
                    $('#year').html(html);
                    $('#model').html('<option value="">Select year first</option>'); 
                }
            }); 
        }else{
            $('#model').html('<option value="">Select make first</option>');
            $('#year').html('<option value="">Select model first</option>'); 
        }
    });
    
    $('#year').on('change', function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'load_car.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#model').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>


<script>
$(document).ready(function(){
$('#phone-number', '#example-form')

    .keydown(function (e) {
        var key = e.charCode || e.keyCode || 0;
        $phone = $(this);

        // Auto-format- do not expose the mask as the user begins to type
        if (key !== 8 && key !== 9) {
            if ($phone.val().length === 4) {
                $phone.val($phone.val() + ')');
            }
            if ($phone.val().length === 5) {
                $phone.val($phone.val() + ' ');
            }           
            if ($phone.val().length === 9) {
                $phone.val($phone.val() + '-');
            }
        }

        // Allow numeric (and tab, backspace, delete) keys only
        return (key == 8 || 
                key == 9 ||
                key == 46 ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105)); 
    })
    
    .bind('focus click', function () {
        $phone = $(this);
        
        if ($phone.val().length === 0) {
            $phone.val('(');
        }
        else {
            var val = $phone.val();
            $phone.val('').val(val); // Ensure cursor remains at the end
        }
    })
    
    .blur(function () {
        $phone = $(this);
        
        if ($phone.val() === '(') {
            $phone.val('');
        }
    });
    });
</script>


</body>
</html>
     
     
