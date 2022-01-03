<?php

if ($httpMethod == "GET") 
{
    /*Search Movies by multiple inputs such as Title, Genres*/
    /*If there are no user inputs the current query returns all movies*/
    $search_input = $_GET["searchText"]; /*user input for search --> string parameter*/
    $genres_input = $_GET["category"]; /*user selection for genre --> string parameter*/
    $topMovies_input = $_GET["bestMovies"]; /*user selection for bestMovies (popularity index) --> boolean parameter*/

    $search_array_input = explode(' ', RemoveSpecialCharactersFromString($search_input));

    $sql_query = "SELECT DISTINCT TITLE, POSTER_IMAGE, OVERVIEW, VOTE_AVERAGE, POPULARITY FROM movies ";

    $search_byTitle = !IsNullOrEmptyString($search_input);
    $search_byGenre = !IsNullOrEmptyString($genres_input);
    if ($search_byTitle || $search_byGenre)
    {
        if ($search_byTitle)
        {
            $sql_query .= "LEFT JOIN roles ON roles.IMDB_ID = movies.IMDB_ID LEFT JOIN cast_members ON cast_members.IMDB_NAME_ID = roles.IMDB_NAME_ID ";
        }
        $sql_query .= "WHERE ";
    }

    if ($search_byTitle)
    {
        $sql_query_byTitle = "";
        $sql_query_byActor = "";
        $sql_query_byCharacter = "";
        foreach($search_array_input as $value)
        {            
            $sql_query_byTitle .= " (movies.TITLE LIKE '%".$value."%' AND ";
            $sql_query_byActor .= " (cast_members.NAME LIKE '%".$value."%' AND ";
            $sql_query_byCharacter .= " (roles.CHARACTER LIKE '%".$value."%' AND ";
        }

        $tmp = explode(' ', trim($sql_query_byTitle));
        $last_query_word = end($tmp); /*get last_word of sql query*/
        if ($last_query_word == "AND")
        {
            $sql_query_byTitle = preg_replace('/\W\w+\s*(\W*)$/', '$1', $sql_query_byTitle); /*remove last word*/
            $sql_query_byTitle .= ") OR ";
        }

        $tmp = explode(' ', trim($sql_query_byActor));
        $last_query_word = end($tmp); /*get last_word of sql query*/
        if ($last_query_word == "AND")
        {
            $sql_query_byActor = preg_replace('/\W\w+\s*(\W*)$/', '$1', $sql_query_byActor); /*remove last word*/
            $sql_query_byActor .= ") OR ";
        }

        $tmp = explode(' ', trim($sql_query_byCharacter));
        $last_query_word = end($tmp); /*get last_word of sql query*/
        if ($last_query_word == "AND")
        {
            $sql_query_byCharacter = preg_replace('/\W\w+\s*(\W*)$/', '$1', $sql_query_byCharacter); /*remove last word*/
            $sql_query_byCharacter .= ") ";
        }

        $sql_query .= $sql_query_byTitle;
        $sql_query .= $sql_query_byActor;
        $sql_query .= $sql_query_byCharacter;
    }
    if ($search_byGenre)
    {
        $tmp = explode(' ', trim($sql_query));
        $last_query_word = end($tmp); /*get last_word of sql query*/
        if ($last_query_word != "WHERE")
        {
            $sql_query .= "AND ";
        }
        $sql_query .= "GENRES LIKE '%".$genres_input."%' ";
    }

    if (is_bool($topMovies_input) === true)
    {
        $sql_query .= "ORDER BY POPULARITY DESC ";
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
	/*header('HTTP/1.1 200 ΟΚ');--not needed*/
}

function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}

function RemoveSpecialCharactersFromString($string) 
{
    $out = preg_replace('/[^A-Za-z0-9]/', ' ', $string);
    return $out; // Removes all special chars.
}
?>