<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
     <title>Travelchec Dashboard</title>
     <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
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
              <h1>System Adminstrator Dashboard</h1>
              <h2><label id="lblGreetings"></label><?php echo $_SESSION['user']['username']; ?></h2>

                <div class="row">
                  <div class="column">
                    <div class="card bg-c-blue">
                      <h3>Employees</h3>
                      <h2 class="text-right"><i class="fas fa-user f-left"></i><span>486</span></h2>
                      <p class="m-b-0">Employees<span class="f-right">351</span></p>
                    </div>
                  </div>

                  <div class="column">
                    <div class="card bg-c-green">
                      <h3>Users</h3>
                      <h2 class="text-right"><i class="fa fa-users f-left"></i><span>486</span></h2>
                      <p class="m-b-0">Active users<span class="f-right">351</span></p>
                    </div>
                  </div>
                </div> 
            </div>
           
         <?php }elseif ($_SESSION['user']['role'] == 'accounts') { ?>
           <!-- Dashboard card if user is accounts department-->
            <div class="content-body"><br><br>
              <h1>Accounts Department Dashboard</h1>
              <h2><label id="lblGreetings"></label><?php echo $_SESSION['user']['username']; ?></h2>

                <div class="row">
                  <div class="column">
                    <div class="card bg-c-blue">
                      <h3>Employees</h3>
                      <h2 class="text-right"><i class="fas fa-user f-left"></i><span>486</span></h2>
                      <p class="m-b-0">Employees<span class="f-right">351</span></p>
                    </div>
                  </div>

                  <div class="column">
                    <div class="card bg-c-yellow">
                      <h3>Report</h3>
                      <h2 class="text-right"><i class="fas fa-sticky-note f-left"></i><span>486</span></h2>
                      <p class="m-b-0">Active reports<span class="f-right">351</span></p>
                    </div>
                  </div>
                </div> 
            </div>


         <?php }elseif ($_SESSION['user']['role'] == 'hr') { ?>
           <!--Dashboard card if user is human resource department-->
          <div class="content-body"><br><br>
              <h1>Human Resource Department Dashboard</h1>
              <h2><label id="lblGreetings"></label><?php echo $_SESSION['user']['username']; ?></h2>

                <div class="row">
                  <div class="column">
                    <div class="card bg-c-blue">
                      <h3>Employees</h3>
                      <h2 class="text-right"><i class="fas fa-user f-left"></i><span>486</span></h2>
                      <p class="m-b-0">Employees<span class="f-right">351</span></p>
                    </div>
                  </div>

                  <div class="column">
                    <div class="card bg-c-green">
                      <h3>Motor Vehicle</h3>
                      <h2 class="text-right"><i class="fas fa-car f-left"></i><span>486</span></h2>
                      <p class="m-b-0">Active motor vechicle<span class="f-right">351</span></p>
                    </div>
                  </div>

                  <div class="column">
                    <div class="card bg-c-yellow">
                      <h3>Report</h3>
                      <h2 class="text-right"><i class="fas fa-sticky-note f-left"></i><span>486</span></h2>
                      <p class="m-b-0">Active reports<span class="f-right">351</span></p>
                    </div>
                  </div>
                </div> 
            </div>

         <?php }

        ?>
     <?php } else { ?>
        <!--Remove content body if user is not login-->

     <?php }
    ?> 

</div>
<!--Main content area end--> 







    
<script>
    var myDate = new Date();
    var hrs = myDate.getHours();

    var greet;

    if (hrs < 12)
        greet = 'Good Morning!';
    else if (hrs >= 12 && hrs <= 17)
        greet = 'Good Afternoon!';
    else if (hrs >= 17 && hrs <= 24)
        greet = 'Good Evening!';

    document.getElementById('lblGreetings').innerHTML =
        '' + greet + ' ';
</script>     
    
</body>
</html>
     
     
