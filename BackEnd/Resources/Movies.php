<?php

$sql = "SELECT TITLE, POSTER_IMAGE, OVERVIEW, VOTE_AVERAGE, POPULARITY FROM  movies";

if (isset($_GET["category"])) {
	$sql .= " WHERE GENRES LIKE '" . htmlspecialchars($_GET["category"]) . "'";
}

$result = mysqli_query($mysqli, $sql);
	if($result) {
		$return_data = [];
		while ($row = $result->fetch_assoc()) {

			$movies[] = array(
									"title" => $row['TITLE'], 
									"posterImage" => "https://image.tmdb.org/t/p/w500" . $row['POSTER_IMAGE'], 
									"overview" => $row['OVERVIEW'],
									"voteAverage" => $row['VOTE_AVERAGE'], 
									"popularity" => $row['POPULARITY']
									);                 
		}
    }

echo json_encode($movies, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>