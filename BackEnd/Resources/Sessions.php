<?php

if ($httpMethod == "POST") {
	if (isset($json["username"]) && isset($json["password"])) {
	
		$sql = "SELECT * FROM users WHERE USERNAME = ? AND PASSWORD = ?";
		if (!($stmt = $mysqli->prepare($sql))) {
			print "Prepared failed:(" . $mysqli->errno . ") " . $mysqli->error;
		}
		if (!$stmt->bind_param("ss", $json["username"], $json["password"])) {
			print "Binding parameters failed:(" . $stmt->errno . ")" . $stmt->error;
		}
		if (!$stmt->execute()) {
			print "Execute failed:(" . $stmt->errno . ")" . $stmt->error;
		}
		
		$matchedUsers = $stmt->get_result()->num_rows;
		print $matchedUsers;
	
		$_SESSION["username"] = $json["username"];
		header('HTTP/1.1 201 Created');
	} else {
		header('HTTP/1.1 400 Bad Request');
	}
} else if ($httpMethod == "DELETE"){
	session_destroy();
}else if ($httpMethod == "GET"){
	if (isset($_SESSION["username"])) {
		echo $_SESSION["username"];
	}
}
else {
	header('HTTP/1.1 405 Method Not Allowed');
}
?>