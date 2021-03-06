<?php

if ($httpMethod == "POST") 
{
	/*Request body requires userid, movieid, comment in JSON format*/
	if (isset($_SESSION["userid"]) && isset($json["movieId"]) && isset($json["commentText"])) 
	{
		$userId = $_SESSION["userid"]; /*get user id from active session*/
		
		//Insert in DB
		$sql = "INSERT INTO reviews (USER_ID, IMDB_ID , REVIEW_TEXT, DATE_OF_REVIEW) VALUES(?, ?, ?, ?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ssss", $userId, $json["movieId"], $json["commentText"], date("Y-m-d H:i:s") /* get instant Datetime */);

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
	$movieid_input = ""; /*user input for search --> string parameter*/
    if (isset($_GET["movieId"]))
    { 
        $movieid_input = trim($_GET["movieId"]); 
    }
  
    $search_byMovieId = !IsNullOrEmptyString($movieid_input);
	if(!$search_byMovieId)
	{ exit; }
	
	$sql_query = "SELECT reviews.*, users.USERNAME FROM reviews INNER JOIN users ON reviews.USER_ID = users.USER_ID WHERE IMDB_ID = '".$movieid_input."'";

	$result = mysqli_query($mysqli, $sql_query);

	if($result) 
    {
		$comments = array();
		while ($row = $result->fetch_assoc()) 
        {
			if ($row != null)
			{ 
                /*array_push($movies, $row);*/
                $comments[] = array
				(
                    "movieId" => $row['IMDB_ID'], 
                    "userId" => $row['USER_ID'], 
					"username" => $row['USERNAME'],
                    "commentText" => $row['REVIEW_TEXT'], 
					"commentDate" => $row['DATE_OF_REVIEW'], 
				);
            }
		}
		echo json_encode($comments, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		/*header('HTTP/1.1 200 ΟΚ'); -- not needed*/
	}
	else
	{
		header('HTTP/1.1 501 Not Implemented');
	}
} 
else if ($httpMethod == "DELETE") 
{
	header('HTTP/1.1 501 Not Implemented');
}
else {
	header('HTTP/1.1 405 Method Not Allowed');
}


function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}
?>