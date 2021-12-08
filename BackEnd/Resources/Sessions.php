<?php

if ($httpMethod == "POST") {
	if (isset($json["username"]) && isset($json["password"])) {
		//Pending check in DB
		
		header('HTTP/1.1 501 Not Implemented');
	} else {
		header('HTTP/1.1 400 Bad Request');
	}
} else {
	header('HTTP/1.1 405 Method Not Allowed');
}
?>