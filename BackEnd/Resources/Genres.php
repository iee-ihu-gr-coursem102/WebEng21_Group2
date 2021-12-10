<?php
if ($httpMethod == "GET") {
	$data = array("Drama", "Action", "Romance");
	echo json_encode($data);
	header('HTTP/1.1 200 ΟΚ');
}

?>