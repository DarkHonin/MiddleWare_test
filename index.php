<?php
require_once("middleware/middleware.php");

APP\configMiddleware();
APP\load_module("ACCESS");
ACCESS\open_entry($_SERVER["REQUEST_URI"]);
?>