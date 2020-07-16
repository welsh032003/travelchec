<?php  
  
session_start(); 
  
// To check if session is started. 
if(isset($_SESSION["user"]["role"]))  
{ 
    if(time()-$_SESSION["login_time_stamp"] >5000)   
    { 
        session_unset(); 
        session_destroy(); 
        header("Location: home.php"); 
    } 
} 
else
{ 
   header("Location: adminpage.php") ;
} 
?> 