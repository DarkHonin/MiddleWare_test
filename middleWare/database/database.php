<?php

namespace DB;

function init(){
	$cfg = \CFG\readConfig("database");
	DataObject::$DB = new MySQLDB("Camagru");
	DataObject::$DB->connect($cfg['username'], $cfg['password']);
	DataObject::$DB->useDatabase();
	echo "Database init\n";
}

function install(){
	DataObject::$DB->create(DataObject::$DB)->if_not_exists()->send();
	DataObject::$DB->useDatabase();
}


?>