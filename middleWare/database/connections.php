<?php

function DB_Connect($pass, $user, $db){
	$host = 'localhost';
	$dsn = "mysql:host=$host";//;dbname=$db
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION ,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => true
	];
	try {
		$pdo = new PDO($dsn, $user, $pass, $options);
	} catch (\PDOException $e) {
		if($e->getCode() == 2002)
			die("Could not connect to database");
		throw $e;
	}
	return $pdo;
}

?>