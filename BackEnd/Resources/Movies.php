<?php

$data[] = array(
    "MOVIEID" => 1, 
    "DESCRIPTION" => "Captain Jack Sparrow ", 
    "TITLE" => "Pirates of Caribean: The Curse of the Black pearl", 
    "LANGUAGE" => "Greek", 
    "POSTER_IMAGE" => "Images/piratesOfCaribean.jpg", 
    "GENREID" => 1
);
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

?>