<?php
header("Content-Type: text/plain");
require_once("middleware/middleware.php");

APP\configMiddleware();
APP\load_module("DB");
require_once("app/migrations/0User.class.php");
APP\modstat();

($table = new User())->set([
	"username" => "Arnold",
	"email" => "arn@old.com",
	"token" => md5("token"),
	"pass" => md5("pass")
]);

$table->insert()->send();

?>