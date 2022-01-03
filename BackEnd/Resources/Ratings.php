<?php

if ($httpMethod == "POST") 
{ 	/*Request body requires userid, movieid, rating in JSON format*/
	if (isset($_SESSION["userid"]) && isset($json["movieid"]) && isset($json["rating"])) {
		
		$userId = $_SESSION["userid"];
		/* We add rating in the specific movie*/
		$sql = "INSERT INTO ratings(IMDB_ID, USER_ID, VOTE_RATING) VALUES (?, ?, ?)";
		
		if (!($stmt = $mysqli->prepare($sql))) {
			print "Prepared failed:(" . $mysqli->errno . ") " . $mysqli->error;
			exit;
		}
		if (!$stmt->bind_param("sid", $json["movieid"], $userId, $json["rating"])) {
			print "Binding parameters failed:(" . $stmt->errno . ")" . $stmt->error;
			exit;
		}
		if (!$stmt->execute()) {
			if ($stmt->errno == 1062) {
				
				$sql = "UPDATE ratings SET VOTE_RATING =" . $json["rating"] . " WHERE  IMDB_ID LIKE '" . $json["movieid"] . "' AND USER_ID = " . $userId;
				
				$mysqli->query($sql);
				header('HTTP/1.1 204 No content');
				//exit;	
			} 	//exit;
		} else { 
			header('HTTP/1.1 201 Created');
			}
		
		if ($mysqli->affected_rows == 1) {
			
			/*We find rated movie data*/
			$sql = "SELECT * FROM movies WHERE IMDB_ID = ?";
			if (!($stmt = $mysqli->prepare($sql))) {
				print "Prepared failed:(" . $mysqli->errno . ") " . $mysqli->error;
				header('HTTP/1.1 500 Internal Server Error');
				exit;			}
			if (!$stmt->bind_param("s", $json["movieid"])) {
				print "Binding parameters failed:(" . $stmt->errno . ")" . $stmt->error;
				header('HTTP/1.1 500 Internal Server Error');
				exit;
			}
			if (!$stmt->execute()) {
				print "Execute failed:(" . $stmt->errno . ")" . $stmt->error;
				header('HTTP/1.1 500 Internal Server Error');
				exit;
			}
			$result = $stmt->get_result();
			$matchedMovies = $result->num_rows;
			$row = $result->fetch_assoc(); // fetch_result returns array inde with 1,2,3,4
			//print "Result " . $row["VOTE_AVERAGE"] . "---" . $row["VOTE_COUNT"] . " ---" . $json["rating"];
			$stmt->close();
			
			/*We calculate the new average and update movie data*/
			$total_average = ($row["VOTE_AVERAGE"] * $row["VOTE_COUNT"] + $json["rating"]) / ($row["VOTE_COUNT"] + 1); 
			//print "Total average =>" . $total_average;
			if ($matchedMovies == 1) {
				$sql = "UPDATE movies SET VOTE_AVERAGE = ?, VOTE_COUNT = VOTE_COUNT + 1 WHERE movies.IMDB_ID = ?";
			
				if (!($stmt = $mysqli->prepare($sql))) {
					print "Prepared failed:(" . $mysqli->errno . ") " . $mysqli->error;
					header('HTTP/1.1 500 Internal Server Error');
					exit;
				}
				if (!($stmt->bind_param("ds", $total_average, $json["movieid"]))) {
					print "Binding parameters failed:(" . $stmt->errno . ")" . $stmt->error;
					header('HTTP/1.1 500 Internal Server Error');
					exit;
				}
				if (!$stmt->execute()) {
					print "Execute failed:(" . $stmt->errno . ")" . $stmt->error;
					header('HTTP/1.1 500 Internal Server Error');
					exit;
				}
				
				exit;	
			}	
		}
	} else {
		header('HTTP/1.1 401 Anauthorized');
		exit;
	}
} else if ($httpMethod == "GET") 
{   if (isset($_SESSION["userid"]) && isset($json["movieid"])) {
		$userid = $_SESSION["userid"];
		$movieid = $json["movieid"];
	
		$sql = "SELECT * FROM ratings WHERE IMDB_ID = ? AND USER_ID = ?";

		if (!($stmt = $mysqli->prepare($sql))) {
			print "Prepared failed:(" . $mysqli->errno . ") " . $mysqli->error;
			header('HTTP/1.1 500 Internal Server Error');
			exit;			
		}
		if (!$stmt->bind_param("si", $movieid, $userid)) {
			print "Binding parameters failed:(" . $stmt->errno . ")" . $stmt->error;
			header('HTTP/1.1 500 Internal Server Error');
			exit;
		}
		if (!$stmt->execute()) {
			print "Execute failed:(" . $stmt->errno . ")" . $stmt->error;
			header('HTTP/1.1 500 Internal Server Error');
			exit;
		}
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$data = array("voted_rating" => $row["VOTE_RATING"],
				 "movieid" => $movieid
				 );
		echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

		header('HTTP/1.1 200 OK');
		exit;	
	} 
    else {
		header('HTTP/1.1 401 Anauthorized');
		exit;
	}
	
	
}


?>