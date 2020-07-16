<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['enable']) {
		
		require_once 'inc/config.php';



		$query = "UPDATE employee_details SET status = '' WHERE id = '".$_POST["enable"]."' ";
		$stmt = mysqli_query($conn, $query);
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Employee enabled Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to enable employee ...';
		}
		echo json_encode($response);
	}