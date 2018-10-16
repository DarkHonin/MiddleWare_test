<?php

function DB_Connect($pass, $user, $db){
	$host = '127.0.0.1';
	$dsn = "mysql:host=$host";//;dbname=$db
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION ,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => true
	];
	try {
		$pdo = new PDO($dsn, $user, $pass, $options);
	} catch (\PDOException $e) {
		switch ($e->getCode()){
			case "2002":
				die ("Failed to connect to database server");
		}
		
	}
	return $pdo;
}

?>