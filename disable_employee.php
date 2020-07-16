<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['disable']) {
		
		require_once 'inc/config.php';
		
		$empid = $_POST['disable'];



		$query = "UPDATE employee_details SET status = 'disabled' WHERE id = '".$_POST["disable"]."' ";
		$stmt = mysqli_query($conn, $query);
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Employee deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete employee ...';
		}
		echo json_encode($response);
	}