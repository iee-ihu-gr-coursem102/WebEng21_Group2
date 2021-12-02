<?php

if ($httpMethod == "POST") {
	if (isset($json["username"]) && isset($json["password"])) {
		//Pending check in DB
		
		$_SESSION['username'] = $json["username"];
		header('HTTP/1.1 201 Created');
	} else {
		header('HTTP/1.1 400 Bad Request');
	}
} else {
	header('HTTP/1.1 405 Method Not Allowed');
}
?>