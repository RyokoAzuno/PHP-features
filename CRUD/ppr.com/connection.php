<?php
	define('DB_SERVER', 'localhost');
	define('DB_NAME', 'ppr');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	
	$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	if($mysqli === false)
	{
		die("Ошибка: Невозможно соединиться. " . $mysqli->connect_error);
	}
?>