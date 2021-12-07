<?php

echo "test before";
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
echo "test after";

?>