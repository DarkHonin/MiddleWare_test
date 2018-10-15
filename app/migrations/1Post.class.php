<?php

class Post extends DB\Table{
	function __construct($db){
		parent::__construct("Posts", $db);
	}

	function migrate(DB\TableQuery $q){
		$ID = new DB\TableData("id", "INT");
		$User = new DB\TableData("user", "INT");
		$File = new DB\TableData("file", "VARCHAR");

		$ID->size(32)->P()->AI();
		$User->size(32)->F("Users(id)");
		$File->size(255);
		
		$q->addField($ID);
		$q->addField($User);
		$q->addField($File);
	}
}


?>