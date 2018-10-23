<?php

namespace App;

final class DataType{

    public static $TEXT;
    public static $USERNAME;
    public static $PASSWORD;
    public static $TOKEN;
    public static $EMAIL;
    public static $INT;

    public $DB_TYPE;
    public $FORM_TYPE;
    public $SIZE;

    private function __construct($DBType, $formType, $size){
        $this->DB_TYPE = $DBType;
        $this->FORM_TYPE = $formType;
        $this->SIZE = $size;
    }

    function __toString(){
        return $this->DB_TYPE;
    }

    function has_size(){
        return ($slef->size)!=null;
    }

    public static function init(){
        self::$TEXT = new self("VARCHAR", "text", 255);
        self::$USERNAME = new self("VARCHAR", "text", 24);
        self::$PASSWORD = new self("VARCHAR", "password", 255);
        self::$TOKEN = new self("VARCHAR", "hidden", 255);
        self::$INT = new self("INT", "number", 32);
        self::$EMAIL = new self("VARCHAR", "email", 36);
    }
}

?>