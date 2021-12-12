<?php
if ($httpMethod == "GET") {

	$result = mysqli_query($mysqli, "SELECT DISTINCT SUBSTRING(GENRES,1, POSITION(',' IN GENRES)-1 ) AS CATEGORY FROM movies ORDER BY GENRES;");
	if($result) {
		$categories = array();
		while ($row = $result->fetch_assoc()) {
			if ($row["CATEGORY"] != "")
				array_push($categories, $row["CATEGORY"]);
		}
		echo json_encode($categories, JSON_PRETTY_PRINT);
	}
	header('HTTP/1.1 200 ΟΚ');
}

?>