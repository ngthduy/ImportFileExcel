<?php

$hostname = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "dangbaoche";

//Kết nối đến CSDL
$db = mysqli_connect($hostname, $dbuser, $dbpassword, $dbname);
if (mysqli_connect_error()) {
	die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
// Change character set to utf8
mysqli_set_charset($db, "utf8");

?>