<?php

namespace DB;

function init(){
	$cfg = \CFG\readConfig("database");
	DataObject::$DB = new Database("Camagru");
	DataObject::$DB->connect();
	$q = new Query("QQ");
	$q->create(DataObject::$DB)->if_not_exists()->send();
	DataObject::$DB->useDatabase();
	echo "Database init\n";
}


?>