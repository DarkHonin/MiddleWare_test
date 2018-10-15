<?php

namespace DB;

require_once(__DIR__."/Query.class.php");

final class Database extends DBStructrue{

    private $_username;
    private $_password;
    private $_database;

    private $_connection;

    function __construct($config){
        $this->_username = $config['username'];
        $this->_password = $config['password'];
        $this->_database = $config['database'];
        parent::__construct($this->_database);
    }

    public function get_database_name(){
        return $this->_database;
    }

    private function handle_error(){
        if (mysqli_connect_error())
            die(mysqli_connect_error());
        if(mysqli_errno($this->_connection))
            die (mysqli_error($this->_connection));
    }

    function connect(){
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $dsn = "mysqli:host=localhost;dbname=$this->_database;charset=".$this->get_charset();
        try {
            $this->_connection = new \PDO($dsn, $this->_username, $this->_password, $options);
        } catch (\PDOException $e){
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    

    function query(){
        return new Query($this);
    }

    function send_query_str($query){
        mysqli_select_db($this->_connection, $this->get_name());
        $result = \mysqli_query($this->_connection, $query);
        $this->handle_error();
    }

    function __destruct(){
        if ($this->_connection)
            mysqli_close($this->_connection);
    }
    
    static function doc(){
        echo file_get_contents(__DIR__."/docs/Database.doc.txt");
    }

    function __toString(){
        return "DATABASE ".$this->get_name();
    }

}

?>