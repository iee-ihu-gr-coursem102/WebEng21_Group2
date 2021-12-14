<?php

/*demo data*/
/*$data[] = array(
    "MOVIEID" => 1, 
    "DESCRIPTION" => "Captain Jack Sparrow ", 
    "TITLE" => "Pirates of Caribean: The Curse of the Black pearl", 
    "LANGUAGE" => "Greek", 
    "POSTER_IMAGE" => "Images/piratesOfCaribean.jpg", 
    "GENREID" => 1
);
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
*/

if ($httpMethod == "GET") 
{
    /*Search Movies by multiple inputs such as Title, Genres*/
    /*If there are no user inputs the current query returns all movies*/
    $search_input = ""; /*user input for search*/
    $genres_input = ""; /*user selection for genre*/
    $sql_query = "SELECT * FROM movies ";

    $search_byTitle = !IsNullOrEmptyString($search_input);
    $search_byGenre = !IsNullOrEmptyString($genres_input);
    if ($search_byTitle || $search_byGenre)
    {
        $sql_query += "WHERE ";
    }

    if ($search_byTitle)
    {
        $sql_query += "TITLE LIKE '%" + $search_input + "%' ";
    }
    if ($search_byTitle)
    {
        if (array_pop(explode(' ', trim($sql_query))) /*get last_word of sql query*/ != "WHERE")
        {
            $sql_query += "AND ";
        }
        $sql_query += "GENRES LIKE '%" + $search_input + "%' ";
    }

	$result = mysqli_query($mysqli, $sql_query);

	if($result) 
    {
		$movies = array();
		while ($row = $result->fetch_assoc()) 
        {
			if ($row != null)
			{ 
                array_push($movies, $row); 
            }
		}
		echo json_encode($movies, JSON_PRETTY_PRINT);
	}
	header('HTTP/1.1 200 ΟΚ');
}

function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}
?>