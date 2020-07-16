<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['reassign']) {
		
		require_once 'inc/config.php';
		
		$mvid = intval($_POST['reassign']);
		


		$query = "UPDATE motor_vehicle SET status = 'reassigned' WHERE emp_id=:mvid AND status != 'reassigned' ";
		$stmt = $DBcon->prepare( $query );
		$stmt->execute(array(':mvid'=>$mvid));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Motor Vehicle Reassigned Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to reassign motor vehicle ...';
		}
		echo json_encode($response);
	}