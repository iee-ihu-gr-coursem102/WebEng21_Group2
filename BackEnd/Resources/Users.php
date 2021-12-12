<?php

if ( $httpMethod == "POST") {
	if (isset($json["username"]) && isset($json["password"]) && isset($json["email"])) {
	        
		$sql = "INSERT INTO users(USERNAME, PASSWORD , EMAIL) VALUES(?, ?, ?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("sss", $json["username"], $json["password"], $json["email"]);

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







?>