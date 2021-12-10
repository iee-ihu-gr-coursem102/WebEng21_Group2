<?php

if ($_SERVER['REMOTE_ADDR']=='::1')
{
	$mysqli = new mysqli('localhost', 'root', '', 'moviesdb');

    if ($mysqli->connect_errno)
    {
        echo "Failed to connect to MySQL. ";
		header('HTTP/1.1 503 Service Unavailable');
    }
}
else
{
	$mysqli = new mysqli('', 'root', '1234', 'moviesdb', 'mysql.sock');
    if ($mysqli->connect_errno)
    {
        echo "Failed to connect to MySQL. ";
        header('HTTP/1.1 503 Service Unavailable');
    }
}

?>