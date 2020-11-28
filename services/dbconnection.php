<?php
session_start();

$server = 'localhost';
$namedb = 'zuii';
$usernamedb = 'root';
$passworddb = '';

$connection = mysqli_connect($server, $usernamedb, $passworddb, $namedb);
mysqli_set_charset($connection, "utf-8");

if(mysqli_connect_error()){
	$_SESSION['message'] = 'Connection to the database has failed';
	header('Location: ../index.php');
}
?>