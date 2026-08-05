<?php
	if (!isset($_POST['username']) && isset($_POST['password'])) {
		http_response_code(401);
		exit('Invalid input');
	}
	session_start();
	$input = json_decode(file_get_contents('php://input'), true);

	if ($input) {
		$_SESSION['username'] = $input['username'] ?? '';
		$_SESSION['password'] = $input['password'] ?? '';
		$_SESSION['role']     = $input['role'] ?? '';
		$_SESSION['email']    = $input['email'] ?? '';
	} else {
		http_response_code(400);
		exit('Invalid input');
	}

	var_dump($_SESSION);
	exit();
?>