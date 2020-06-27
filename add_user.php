<?php
	include 'inc/config.php';
	$username=$_POST['username'];
	$email=$_POST['email'];
	$role=$_POST['role'];
	$password=$_POST['password'];


	$check = "SELECT * FROM user_accounts WHERE UserName = '$username' and UserEmail = '$email' ";
	$query = mysqli_query($conn, $check);
	if (mysqli_num_rows($query) == 1 ) {
		print "2";
	}else{

	$sql = "INSERT INTO `user_accounts`( `UserName`, `UserEmail`, `UserType`, `Password`, `UserStatus`) 
	VALUES ('$username','$email', '$role', '".md5($password)."', 'active')";
	if (mysqli_query($conn, $sql)) {
		  print"1";
	} 
	

}


	mysqli_close($conn);
?>