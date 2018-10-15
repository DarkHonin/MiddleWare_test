<?php

namespace DB;

class Query{

    private const _QUERY_PARTS = [
        "CREATE" =>[
                "DATABASE",
                "TABLE"
                ]
        ];

    private $_db;

    private $_q_str = "";

    private $_format = [];

    function __construct(Database $database, $format){
        $this->_db;
        $this->_format = $format;
    }

    function create($option, $name = Null){
        if ($option == 1)
        $this->_q_str = "CREATE ".Query::_QUERY_PARTS["CREATE"][$option]." ".$name;
        return $this;
    }

    function ifNotExist(){
        $this->_q_str
    }

    function get_query_string(){
        return $this->_q_str;
    }
}


?>