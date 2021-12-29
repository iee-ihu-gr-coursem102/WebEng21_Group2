<?php

if ($httpMethod == "POST") 
{ 	/*Request body requires userid, movieid, rating in JSON format*/
	if (isset($json["userid"]) && isset($json["movieid"]) && isset($json["rating"])) {
		
		
		/* We add rating in the specific movie*/
		$sql = "INSERT INTO ratings(IMDB_ID, USER_ID, VOTE_RATING) VALUES (?, ?, ?)";
		
		if (!($stmt = $mysqli->prepare($sql))) {
			print "Prepared failed:(" . $mysqli->errno . ") " . $mysqli->error;
			exit;
		}
		if (!$stmt->bind_param("sid", $json["movieid"], $json["userid"], $json["rating"])) {
			print "Binding parameters failed:(" . $stmt->errno . ")" . $stmt->error;
			exit;
		}
		if (!$stmt->execute()) {
			print "Execute failed:(" . $stmt->errno . ")" . $stmt->error;
			exit;
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
			$total_average = ($row["VOTE_AVERAGE"] + $json["rating"]) / 2 ;
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
				header('HTTP/1.1 201 Created');
				exit;	
			}	
		}
	}
} else if ($httpMethod == "GET") 
{
	
	header('HTTP/1.1 501 Not Implemented');
	exit;	
	
}


?>