<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['enable']) {
		
		require_once 'inc/config.php';
		
		$uid = $_POST['enable'];



		$query = "UPDATE user_accounts SET UserStatus = 'enable' WHERE id = '".$_POST["enable"]."' ";
		$stmt = mysqli_query($conn, $query);
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'User activated Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete employee ...';
		}
		echo json_encode($response);
	}