<?php

namespace DB;

class Query{

    private $_db;

    private $_q_str = "";

    function __construct(Database $database){
        $this->_db = $database;
    }

    function get_query_string(){
        return $this->_q_str;
    }

    function create($db){
        if (\App\hasParent("DB\DBStructure", get_class($db)))
            throw new \TypeError("'$db' : ".get_parent_class($db)." is not a valid 'DBStructrue'");
        $this->_q_str = "CREATE $db";
        return $this;
    }

    function send(){
        $this->_db->send_query_str($this->_q_str);
    }

}


?>