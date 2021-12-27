<?php

if ($httpMethod == "GET") 
{
    /*Search Movies by multiple inputs such as Title, Genres*/
    /*If there are no user inputs the current query returns all movies*/
    $search_input = $_GET["searchText"]; /*user input for search*/
    $genres_input = $_GET["category"]; /*user selection for genre*/
    $sql_query = "SELECT TITLE, POSTER_IMAGE, OVERVIEW, VOTE_AVERAGE, POPULARITY FROM movies ";

    $search_byTitle = !IsNullOrEmptyString($search_input);
    $search_byGenre = !IsNullOrEmptyString($genres_input);
    if ($search_byTitle || $search_byGenre)
    {
        $sql_query += "WHERE ";
    }

    if ($search_byTitle)
    {
        $sql_query += "TITLE LIKE '%" + htmlspecialchars($search_input) + "%' ";
    }
    if ($search_byGenre)
    {
        if (array_pop(explode(' ', trim($sql_query))) /*get last_word of sql query*/ != "WHERE")
        {
            $sql_query += "AND ";
        }
        $sql_query += "GENRES LIKE '%" + htmlspecialchars($genres_input) + "%' ";
    }

	$result = mysqli_query($mysqli, $sql_query);

	if($result) 
    {
		$movies = array();
		while ($row = $result->fetch_assoc()) 
        {
			if ($row != null)
			{ 
                /*array_push($movies, $row);*/
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
	}
	header('HTTP/1.1 200 ΟΚ');
}

function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}
?>