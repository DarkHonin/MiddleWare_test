<?php
header("Content-Type: text/plain");
require_once("middleware/middleware.php");

APP\configMiddleware();
APP\load_module("ACCESS");
APP\load_module("DB");
ACCESS\open_entry($_SERVER["REQUEST_URI"]);
?>