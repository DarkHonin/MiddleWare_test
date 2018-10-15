<?php

namespace DB;

class QueryCreate extends Query{

    private $_database_name;
    private $_if_not_exists;

    function __construct(Database $db){
        paretn::__construct($db, [
            "_CREATE", 
            "?WHAT"=>["DATABASE", "TABLE"], 
            "*INE"=>"IF NOT EXISTS",
            "-WHAT"=>[
                "DATABASE" => "!DBName",
                "TABLE" => "!Coulumns"
            ]
        ]);
    }
}

?>