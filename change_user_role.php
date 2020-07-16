<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['getid']) {
		
		require_once 'inc/config.php';
	

		$query = "UPDATE user_accounts SET UserType = '".$_POST["role"]."' WHERE id = '".$_POST["getid"]."' ";
		$stmt = mysqli_query($conn, $query);
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'User Role Changed Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete employee ...';
		}
		echo json_encode($response);
	}