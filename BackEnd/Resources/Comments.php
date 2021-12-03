<?php

if ($httpMethod == "POST") {
	if (isset($json["userid"]) && isset($json["movied"]) && isset($json["commentText"])) {
		//Insert in DB
		
		$data = array("commentid" => 1); // Demo data for now
		echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
		header('HTTP/1.1 201 Created');
	} else {
		header('HTTP/1.1 400 Bad Request');
	}
} else if ($httpMethod == "GET") {
	header('HTTP/1.1 501 Not Implemented');
} else if ($httpMethod == "DELETE") {
	header('HTTP/1.1 501 Not Implemented');
}
else {
	header('HTTP/1.1 405 Method Not Allowed');
}
?>