<?php

function LC($field){
	global $connection;
	$clean_field = mysqli_escape_string($connection, $field);
	$clean_field = htmlspecialchars($clean_field);
	return $clean_field;
}
?>