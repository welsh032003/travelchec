<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['deactive']) {
		
		require_once 'inc/config.php';
		
		$uid = $_POST['deactive'];



		$query = "UPDATE user_accounts SET UserStatus = 'deactive' WHERE id = '".$_POST["deactive"]."' ";
		$stmt = mysqli_query($conn, $query);
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'User deactivated Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete employee ...';
		}
		echo json_encode($response);
	}