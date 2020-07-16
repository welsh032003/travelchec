<html>

<head>
    <title> Login </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<style>
    body{
    margin: 0;
    padding: 0;
    background: url(../Tanajli/img/newback.JPG);
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
}
    .login-form{
        width: 400px;
        height: 420px;
        background: rgba(0, 0, 0, 0.5);
        color: #ffffff;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        box-sizing: border-box;
        padding:80px 40px;
    }
    .avatar{
        width: 100px;
        height: 100px;
        border-radius: 50;
        position:absolute;
        top: -50px;
        left: calc(100%-80px);
    }
    h1{
        
        margin: 0;
        padding: 0 0 20px;
        text-align: center;
        font-size: 30px;
    }
    .login-form p{
        margin: 0;
        padding: 0;
        font-weight: bold;
    }
    .login-form input{
        width: 100;
        margin-bottom: 20px;
    }
    .login-form input[type="text"], input[type="password"]{
        border: none;
        border-bottom: 1px solid white;
        background: transparent;
        outline: none;
        height: 40px;
        color:white;
        font-size: 16px;
        width: 300;
    }
    .login-form input[type="submit"]{
      border: 2px solid;
      outline: none;
      background: darkblue;
      color: white;
      font-size: 18px;
      font-weight: bold;
      border-radius: 20px;
      padding: 4px;
    }
    .login-form input[type="submit"]:hover
    {
        cursor: pointer;
     border: 2px solid;
      outline: none;
      background: white;
      color: darkblue;
      font-size: 18px;
      font-weight: bold;
      border-radius: 20px;
      padding: 4px;
    }
    .login-form a{
        text-decoration: none;
        font-size: 25px;
        color: ghostwhite;
    }
    .login-form a:hover
    {
        color: white;
    }
    #nav a:link, nav a:active, nav a:visited
#header{
    width:100%;
    height: 80px;
    background: white;
    font-family: monospace; 
    font-size: 50px;
    padding: 10px 20px;
    text-decoration: none;
    color: burlywood;
}
ul {
  list-style-type: none;
  margin: 0;
  padding:16;
  overflow: hidden;
  background-color: #000084;
}
     li {
        float: left;
    }
    li a {
        display: grid;
        color: whitesmoke;
        text-align: right;
        padding: 25px;
        text-decoration: none;
        font-weight: bold;
        font-size: 22px;
    }
    li a:hover{
        background-color: gainsboro;
    }

header{
    background-image: url(login1.jpg);
    height: 100%;
    background-size: cover;
    background-position: center;
 
}
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
.fa{
  color:white;
  font-size:27px;
  margin-left:8px;
}
.first-example {
  display: inline-flex;
}

    </style>

    
</head>
    
    <header>
       
         <div class="left_area">
             <ul>
    
               <!-- <li><img src="snip.jpg"></li> -->
                 <li><a href="home.php">Home</a></li>
                 <li><a href="adminpage.php">Back</a></li>
             </ul>
        </div>
    </header>

<body>

    <div class="login-form">
<!--    <img src="./images/login_avatar.PNG" class="avatar">-->

<?php
              

          include 'inc/config.php';
           session_start();

          //Getting Input value
          if(isset($_POST['login'])){
            $username=mysqli_real_escape_string($conn,$_POST['uname']);
            $password=mysqli_real_escape_string($conn,$_POST['psw']);
            $lrole= $_REQUEST['lpage'];

          // Check if username and password is blank
           if(empty($username)&&empty($password)){
            $error= '<div class="alert alert-danger" role="alert">Email and password is required!</div>';

           }else{

           //Check Login Detail with database
           $result=mysqli_query($conn,"SELECT * FROM employee_details WHERE email='$username' AND password='".md5($password)."' ");
           $row=mysqli_fetch_assoc($result);
           $count=mysqli_num_rows($result);


          if ($count==1) {


          if ($row['status'] == 'disabled') {
           $error= '<div class="alert alert-danger" role="alert">Access Denied - Your account was disabled</div>';
         }else{

           //Audit logim
           $audit_type = "Employee Login";
           $audit_message = "login successfully";
           $audit_insert = "INSERT INTO audit_system (`user`, `message`, `type`) VALUES ('$username', '$audit_message', '$audit_type') ";
           $audit_query = mysqli_query($conn, $audit_insert) or die(mysqli_error());


           //Session login time
           $_SESSION["login_time_stamp"] = time();

           //Define session varible
            $_SESSION['employee']=array(
           'id'=>$row['id'],
           'name'=>$row['first_name'],
           'email'=>$row['email']
           );

   
           //Redirect employee to dashboard
           header('location: employee_dashboard.php');
    }

      }else {
        $error='<div class="alert alert-danger" role="alert">Incorrect email and password</div>';
      }
     }

    }
?>


        <?php if(isset($error)){ echo $error; }?>
        <h1>Login</h1>
    <?php
      if (isset($_REQUEST['lpage'])) { ?>
        <form action="" method="post">
          <div>
          <p>Username</p>
          <input type="text" id="uname" name="uname" /> <br/>
          </div>
          <div>
          <p>Password</p> 

        <div class="first-example">
          <input type= "password" id="psw" name= "psw" /> <br/>
          <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
        </div>

          <input type="submit" id="login" name="login" value="Login"/><br/>
          </div>
          <div>
           
          </div>
        </form>
    <?php  } else { ?>
        <h2>Select Login Type:</h2>
        <h4><a href="login.php?lpage=hr">Human Resource <i class="fas fa-arrow-right"></i></a></h4>
        <h4><a href="login.php?lpage=accounts">Accounts <i class="fas fa-arrow-right"></i></a></h4>
        <h4><a href="login.php?lpage=sysadmin">System Administrator <i class="fas fa-arrow-right"></i></a></h4>
    <?php }


    ?>

    </div>



<script type="text/javascript">
  function viewPassword()
  {
    var passwordInput = document.getElementById('psw');
    var passStatus = document.getElementById('pass-status');
   
    if (passwordInput.type == 'password'){
      passwordInput.type='text';
      passStatus.className='fa fa-eye-slash';
      
    }
    else{
      passwordInput.type='password';
      passStatus.className='fa fa-eye';
    }
  }
</script>
    
    </body>
</html>