<?php

namespace FRONT;

class Part extends \App\DataObject{

    private $_format;
    private $_sections = [];

    function __construct($name, $raw){
        $sections = [];
        preg_match_all("/\:([a-z]*)/", $raw, $sections);
        $sections = array_filter($sections[1]);
        $sections_keys = array_flip($sections);
        $sections = array_combine($sections_keys, $sections);
        $this->_sections = $sections;
        parent::__construct($name, []);
        $this->_format = $raw;
    }

    function post(){
        echo $this->assemble();
    }

    function get_data_fields() : array{
        return $this->_sections;
    }

	function get_query_string(): string{
        return $this->_format;
    }
}

?>