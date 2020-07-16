
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
     <title>Travelchec About</title>
     <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-form.css">
    <style type="text/css">
    .center {
          display: block;
          margin-left: auto;
          margin-right: auto;
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

    <h1>About</h1>

    <img class="center" src="img/logopng.png" height="150" width="250">
    <p style="text-align: center; font-size: 30px;"> The TravelChec  Management System is use to store  and track employees vehicle and related documentation in addition to eligibility to receive travel allowance monthly. </p>





    



  </div>
</div>
<!--Main content area end--> 
  <script src="js/jquery/jquery.min.js"></script>
  <script src="js/jquery/jquery-migrate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
</body>
</html>
     
     
