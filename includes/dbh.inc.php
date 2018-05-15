<?php

$bdServername = "localhost";
$dbUsername = "davidgil_admin" ;
$dbPassword = "vYS8cp5P";
$dbName = "davidgil_db" ;

$conn = mysqli_connect($bdServername,$dbUsername,$dbPassword,$dbName);

if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>