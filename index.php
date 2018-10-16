<?php
header("Content-Type: text/plain");
require_once("middleware/middleware.php");

APP\configMiddleware();
APP\load_module("DB");
require_once("app/migrations/0User.class.php");
APP\modstat();

$table = new User();
$table->create($table)->if_not_exists()->send();
$table->select("username")->send();



?>