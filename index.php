<?php

require_once("middleware/middleware.php");

APP\configMiddleware();
APP\load_module("DB");
APP\modstat();

$DB = DB\createDatabase();
$DB->connect();
//$DB->query()->create($DB)->send();
//DB\createMigrations($DB);
?>