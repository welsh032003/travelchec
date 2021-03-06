<?php include 'login_session.php'; ?>


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
    <h1>Add Employee</h1>
<?php
include 'inc/config.php';


if (isset($_POST['submit'])) {
    
    $firstname =mysqli_real_escape_string($conn,$_POST['firstname']);
    $lastname =mysqli_real_escape_string($conn,$_POST['lastname']);
    $email =mysqli_real_escape_string($conn,$_POST['email']);
    $dob =mysqli_real_escape_string($conn,$_POST['dob']);
    $address1 =mysqli_real_escape_string($conn,$_POST['address1']);
    $address2 =mysqli_real_escape_string($conn,$_POST['address2']);
    $parish =mysqli_real_escape_string($conn,$_POST['parish']);
    $mobile =mysqli_real_escape_string($conn,$_POST['mobile']);
    $home =mysqli_real_escape_string($conn,$_POST['home']);

    //check if employee already exist
    $echeck = mysqli_query($conn, "SELECT * FROM employee_details");
    $erow = mysqli_fetch_assoc($echeck);

    if ($erow['email'] == $email ) {
       header("Location: add_employee.php?message= ".$email." already exist in employee database ");
    } else {


    $insert = "INSERT INTO `employee_details` (`first_name`, `last_name`, `email`, `dob`, `address1`, `address2`, `parish`, `mobile`, `home`) VALUES ('$firstname', '$lastname', '$email', '$dob', '$address1', '$address2', '$parish', '$mobile', '$home') ";

   //Audit 
   $audit_type = "Add Employee";
   $audit_user = $_SESSION['user']['username'];
   $audit_message = "add employee ".$firstname." ".$lastname." ";
   $audit_insert = "INSERT INTO audit_system (`user`, `message`, `type`) VALUES ('$audit_user', '$audit_message', '$audit_type') ";
   $audit_query = mysqli_query($conn, $audit_insert) or die(mysqli_error());

    if (mysqli_query($conn, $insert)) {
       header("Location: employee_details.php?message=Employee information added successfully....");
    }
  }
}

mysqli_close($conn);
?>


<?php
if(!empty($_GET['message'])) {
$message = $_GET['message'];
 echo '<p class="message"> '.$message.'</p>';
}
?>

<form id="example-form" action="" method="post" class="form-horizontal plvr">

    <div class="col-25">
        <label>Firstname:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: capitalize;' type="text" name="firstname" required>
    </div>
    <div class="col-25">
        <label>Lastname:</label>
    </div>
    <div class="col-75">
        <input style='width:400px; text-transform: capitalize;' type="text" name="lastname" required>
    </div>
    <div class="col-25">
        <label>Email:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="email" name="email" required>
    </div>
    <div class="col-25">
        <label>Date of Birth:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' max="2001-06-02" min="1930-01-01" type="date" name="dob" required>
    </div>
    <div class="col-25">
        <label>Address 1:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="text" name="address1" required>
    </div>
    <div class="col-25">
        <label>Address 2:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="text" name="address2">
    </div>
    <div class="col-25">
    <label>Parish:</label>
    </div>
    <div class="col-75">
    <select name='parish' style='width:400px;' class='form-control' required><option value=''>Select Parish</option><option value='KINGSTON'>KINGSTON</option><option value='ST. ANDREW'>ST. ANDREW</option><option value='ST. THOMAS'>ST. THOMAS</option><option value='PORTLAND'>PORTLAND</option><option value='ST. MARY'>ST. MARY</option><option value='ST. ANN'>ST. ANN</option><option value='TRELAWNY'>TRELAWNY</option><option value='ST. JAMES'>ST. JAMES</option><option value='HANOVER'>HANOVER</option><option value='WESTMORELAND'>WESTMORELAND</option><option value='ST. ELIZABETH'>ST. ELIZABETH</option><option value='MANCHESTER'>MANCHESTER</option><option value='CLARENDON'>CLARENDON</option><option value='ST. CATHERINE'>ST. CATHERINE</option></select>
    </div>
    <div class="col-25">
        <label>Mobile #:</label>
    </div>
    <div class="col-75">
        <input id="phone-number" maxlength="14" placeholder="(XXX) XXX-XXXX" style='width:400px;' type="text" name="mobile" required>
    </div>
    <div class="col-25">
        <label>Home #:</label>
    </div>
    <div class="col-75">
        <input id="home-number" maxlength="14" placeholder="(XXX) XXX-XXXX" style='width:400px;' type="text" name="home">
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
            $phone.val('(876');
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

//Home phone number

$(document).ready(function(){
$('#home-number', '#example-form')

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
            $phone.val('(876');
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
     
     
