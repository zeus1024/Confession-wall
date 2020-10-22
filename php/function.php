<?php
function db_init()
{
	$conn = mysqli_connect(dbhost, dbuser, dbpass,dbname);
	if( $conn )
	{
 	mysqli_query($conn , "set names utf8mb4");
	}
 return $conn;
}
function innum($name,$default)
{
	if(!is_numeric($tar=$_GET[$name])) $tar=$default;
	return $tar;
}
?>