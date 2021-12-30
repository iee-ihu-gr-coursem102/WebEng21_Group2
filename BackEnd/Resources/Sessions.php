<?php

if ($httpMethod == "POST") {
	if (isset($json["username"]) && isset($json["password"])) {
		$json["password"] = substr( hash('sha256', $json["password"]), 0, 15);
		$sql = "SELECT * FROM users WHERE USERNAME = ? AND PASSWORD = ?";
		if (!($stmt = $mysqli->prepare($sql))) {
			print "Prepared failed:(" . $mysqli->errno . ") " . $mysqli->error;
		}
		if (!($stmt->bind_param("ss", $json["username"], $json["password"]))) {
			print "Binding parameters failed:(" . $stmt->errno . ")" . $stmt->error;
		}
		if (!($stmt->execute())) {
			print "Execute failed:(" . $stmt->errno . ")" . $stmt->error;
		}
		$result = $stmt->get_result();
		
        if ($result->num_rows == 0) {
			//print $stmt->get_result()->num_rows ;
			header('HTTP/1.1 401 Unauthorized');
			exit;
		}
		else {
			$row = $result->fetch_assoc();
			$_SESSION["username"] = $json["username"];
			$_SESSION["userid"] = $row["USER_ID"];//$row["USER_ID"]; 
			header('HTTP/1.1 201 Created');
			exit;
		}
		
	} else {
		header('HTTP/1.1 400 Bad Request');
	}
} else if ($httpMethod == "DELETE"){
	session_destroy();
	header('HTTP/1.1 204 No Content');
}else if ($httpMethod == "GET"){
	if (isset($_SESSION["username"])) {
		echo $_SESSION["username"];
		header('HTTP/1.1 200 OK');
		
	}
}
else {
	header('HTTP/1.1 405 Method Not Allowed');
}
?>