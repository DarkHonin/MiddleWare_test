<?php

class User extends DB\Table{
	function __construct($db){
		parent::__construct("Users", $db);
	}

	function migrate(DB\TableQuery $q){
		$ID = new DB\TableData("id", "INT");
		$NAME = new DB\TableData("username", "VARCHAR");
		$TOKEN = new DB\TableData("sessiontoken", "VARCHAR");

		$ID->size(32)->P()->AI();
		$NAME->size(32)->U();
		$TOKEN->size(255);
		
		$q->addField($ID);
		$q->addField($NAME);
		$q->addField($TOKEN);
	}
}


?>