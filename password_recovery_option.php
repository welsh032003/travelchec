<html>

<head>
    <title>Password Recovery Option</title>
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
    .login-form input[type="email"], input[type="password"]{
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
      width: auto;
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
      width: auto;

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
                 <li><a href="login.php">Back to login</a></li>
             </ul>
        </div>
    </header>

<body>

    <div class="login-form">
<!--    <img src="./images/login_avatar.PNG" class="avatar">-->

<?php
  include 'inc/config.php';
  $user_id = mysqli_real_escape_string($conn,$_REQUEST['uid']);

  $select = mysqli_query($conn, "SELECT * FROM security_question WHERE user_id = '$user_id' ");
  $row = mysqli_fetch_assoc($select);
  if (mysqli_num_rows($select) != 0 ) { ?>
    <h1>Recovery Option</h1><br><br>
    <h4><a href="reset_by_email.php?uid=<?php echo $user_id; ?>">Recover by email <i class="fas fa-arrow-right"></i></a></h4>
    <h4><a href="reset_by_security_question.php?uid=<?php echo $id; ?>">Recover by security question <i class="fas fa-arrow-right"></i></a></h4>
<?php  } else { ?>
    <h1>Recovery Option</h1><br><br>
    <h4><a href="reset_by_email.php?uid=<?php echo $user_id; ?>">Recover by email <i class="fas fa-arrow-right"></i></a></h4>
<?php  }
  
mysqli_close($conn);
?>
 

    </div>


   
    </body>
</html>