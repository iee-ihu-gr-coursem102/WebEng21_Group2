<?php

if ($httpMethod == "POST") 
{
	if (isset($json["userid"]) && isset($json["movieid"]) && isset($json["commentText"])) 
	{
		//Insert in DB
		$sql = "INSERT INTO reviews (USER_ID, IMDB_ID , REVIEW_TEXT, DATE_OF_REVIEW) VALUES(?, ?, ?, ?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("sss", $json["userid"], $json["movieid"], $json["commentText"], date("Y-m-d H:i:s") /* get instant Datetime */);

		if($stmt->execute()) 
		{
			$stmt->close();
			/*$data = array("commentid" => 1); // Demo data for now
		echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);*/
			header('HTTP/1.1 201 Created');
		} 
		else 
		{
			print $stmt->error;
			header('HTTP/1.1 500 Internal Server Error');
		}
	} 
	else 
	{
		header('HTTP/1.1 400 Bad Request');
	}
} 
else if ($httpMethod == "GET") 
{
	header('HTTP/1.1 501 Not Implemented');
} 
else if ($httpMethod == "DELETE") {
	header('HTTP/1.1 501 Not Implemented');
}
else {
	header('HTTP/1.1 405 Method Not Allowed');
}
?>