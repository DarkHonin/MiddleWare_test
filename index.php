<?php

require_once("loader/loader.php");

mod\load_module("config");
mod\load_module("database");

$db = DB\create_db();

//$db->connect();
$db->create();

echo $db->get_query_string();


?>