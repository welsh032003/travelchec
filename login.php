<html>

<head>
    <title> Login </title>
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
        color: darkblue;
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
        border: none;
        outline: none;
        background: white;
        color: darkblue;
        font-size: 18px;
        border-radius: 20px;
    }
    .login-form input[type="submit"]:hover
    {
        cursor: pointer;
        background: gray;
        color: black;
    }
    .login-form a{
        text-decoration: none;
        font-size: 16px;
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

                if(empty($username)&&empty($password)){
                $error= '<div class="alert alert-danger" role="alert">Enter Username and Password</div>';
                }else{


               //Checking Login Detail
               $result=mysqli_query($conn,"SELECT * FROM user_accounts WHERE username='$username' AND password='".md5($password)."' ");
               $row=mysqli_fetch_assoc($result);
               $count=mysqli_num_rows($result);

               if ($row['UserType'] != $lrole) {
                $error= '<div class="alert alert-danger" role="alert">You are loginin as the wrong user</div>';
               }else if($count==1){
               
                  $_SESSION['user']=array(
                 'id'=>$row['id'],
                 'username'=>$row['UserName'],
                 'role'=>$row['UserType']
                 );
                 $role=$_SESSION['user']['role'];


                 //Redirecting User Based on Role
                  switch($role){
                case 'hr':
                header('location: adminpage.php');
                break;
                case 'accounts':
                header('location: adminpage.php');
                break;
                case 'sysadmin':
                header('location: adminpage.php');
                break;
               }
               }else{
               $error='<div class="alert alert-danger" role="alert">No account found</div>';
               }
            }
          }
        ?>


        <?php if(isset($error)){ echo $error; }?>
        <h1>Login</h1>
		<form action="" method="post">
        <div>
        <p>Username</p>
        <input type="text" id="uname" name="uname" /> <br/>
        </div>
        <div>
        <p>Password</p> 
        <input type= "password" id="psw" name= "psw" /> <br/>
        <input type="submit" id="login" name="login" value="Login"/><br/>
        </div>
        <div>
        <a href="#">Forget Password</a> <br/> <br/>
         
        </div>
        </form>
    </div>



  
    
    </body>
</html>