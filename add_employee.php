<?php  session_start(); ?>
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
    $dob =mysqli_real_escape_string($conn,$_POST['dob']);
    $address1 =mysqli_real_escape_string($conn,$_POST['address1']);
    $address2 =mysqli_real_escape_string($conn,$_POST['address2']);
    $parish =mysqli_real_escape_string($conn,$_POST['parish']);
    $mobile =mysqli_real_escape_string($conn,$_POST['mobile']);
    $home =mysqli_real_escape_string($conn,$_POST['home']);
}


?>

<form action="" method="post" class="form-horizontal plvr">

    <div class="col-25">
        <label>Firstname:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="text" name="firstname">
    </div>
    <div class="col-25">
        <label>Lastname:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="text" name="lastname">
    </div>
    <div class="col-25">
        <label>DOB:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="date" name="dob">
    </div>
    <div class="col-25">
        <label>Address 1:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="text" name="address1">
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
    <select name='parish' style='width:400px;' class='form-control'><option value=''>Select Parish</option><option value='KINGSTON'>KINGSTON</option><option value='ST. ANDREW'>ST. ANDREW</option><option value='ST. THOMAS'>ST. THOMAS</option><option value='PORTLAND'>PORTLAND</option><option value='ST. MARY'>ST. MARY</option><option value='ST. ANN'>ST. ANN</option><option value='TRELAWNY'>TRELAWNY</option><option value='ST. JAMES'>ST. JAMES</option><option value='HANOVER'>HANOVER</option><option value='WESTMORELAND'>WESTMORELAND</option><option value='ST. ELIZABETH'>ST. ELIZABETH</option><option value='MANCHESTER'>MANCHESTER</option><option value='CLARENDON'>CLARENDON</option><option value='ST. CATHERINE'>ST. CATHERINE</option></select>
    </div>
    <div class="col-25">
        <label>Mobile #:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="text" name="mobile">
    </div>
    <div class="col-25">
        <label>Home #:</label>
    </div>
    <div class="col-75">
        <input style='width:400px;' type="text" name="home">
    </div>

    <div class="col-25">
        <input class="btn btn-primary" type="submit" value="Save Employee" name="submit">
    </div>

</form>


    



  </div>
</div>
<!--Main content area end--> 




</body>
</html>
     
     
