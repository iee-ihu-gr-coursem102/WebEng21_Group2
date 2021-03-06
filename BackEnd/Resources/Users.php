<?php

if ( $httpMethod == "POST") {
	if (isset($json["username"]) && isset($json["password"]) && isset($json["email"])) {
		
		$json["password"] = substr( hash('sha256', $json["password"]), 0, 15);
		$sql = "INSERT INTO users(USERNAME, PASSWORD , EMAIL) VALUES(?, ?, ?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("sss", $json["username"], $json["password"], $json["email"]);

		validateEmail($json["email"]);
		
		if($stmt->execute()) {
			$stmt->close();
			header('HTTP/1.1 201 Created');
		} else {
			print $stmt->error;
			header('HTTP/1.1 500 Internal Server Error');
		}
	} else {
		header('HTTP/1.1 400 Bad Request');
	}
} else {
	header('HTTP/1.1 405 Method Not Allowed');
}



function validateEmail($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format";
		header("HTTP/1.1 400 Bad Request");
		exit;
	}
}




?>