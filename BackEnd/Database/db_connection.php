<?php

if ($_SERVER['REMOTE_ADDR']=='::1')
{
    $conn = mysqli_connect ('localhost', 'root', '', 'moviesdb');

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL. ";
		header('HTTP/1.1 503 Service Unavailable');
    }
}
else
{
    $conn = mysqli_connect ('', 'root', '1234', 'moviesdb', 'mysql.sock');

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL. ";
        header('HTTP/1.1 503 Service Unavailable');
    }
}

?>