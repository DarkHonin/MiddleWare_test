<?php

namespace DB;

require_once(__DIR__."/Query.class.php");

final class Database extends Query{

    private $_username;
    private $_password;
    private $_database;

    private $_connection;

    function __construct($config){
        $this->_username = $config['username'];
        $this->_password = $config['password'];
        $this->_database = $config['database'];
        parent::__construct($this);
    }

    public function get_database_name(){
        return $this->_database;
    }

    private function handle_error(){
        if(mysqli_errno($this->_connection))
            die (mysqli_error());
    }

    function connect(){
        $this->_connection = mysqli_connect("localhost", $this->_username, $this->_password);
        $this->handle_error();
    }

    function __destruct(){
        if ($this->_connection)
            mysqli_close($this->_connection);
    }
    
    static function doc(){
        echo file_get_contents(__DIR__."/docs/Database.doc.txt");
    }

    function create(){
        parent::create(DB\EQueryCreate::DATABASE, $this->_database);
    }
}

?>