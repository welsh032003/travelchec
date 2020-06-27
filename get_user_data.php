<?php  

include 'config.php';
 if(isset($_POST["user_id"]))  
 {  
      $query = "SELECT * FROM user_accounts WHERE id = '".$_POST["user_id"]."'";  
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>