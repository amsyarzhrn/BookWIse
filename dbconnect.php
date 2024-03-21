<?php
$usnm = "root";
$host = "localhost";
$pswd = "";
$dnme = "bookwise";
$conn = mysqli_connect($host, $usnm, $pswd, $dnme);
if(!$conn)
{
	die("Failed connection. " . mysqli_connect_error());
}
?>