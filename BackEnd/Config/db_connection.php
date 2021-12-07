<?php

if ($_SERVER['REMOTE_ADDR']=='127.0.0.1')
{
    $conn = mysqli_connect ('localhost', 'root', '', 'moviesdb');

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL. ";
        exit();
    }
    else
    {
        echo "Success to connect to MySQL. ";
        exit();
    }
}
else
{
    $conn = mysqli_connect ('', 'root', '1234', 'moviesdb', 'mysql.sock');

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL. ";
        exit();
    }
    else
    {
        echo "Success to connect to MySQL. ";
        exit();
    }
}

?>