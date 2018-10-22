<?php

namespace FRONT;

class Part extends \App\DataObject{

    private $_format;
    private $_sections = [];
    private $_code = [];
    private $_anchors = [];
    private $_parent = "";

    private static function parse_sections($section_data){
        $ret = [];
        foreach($section_data as $e)
            $ret[$e[2]] = $e[3];
        return $ret;
    }

    private static function parse_anchors($anchors){
        $ret = [];
        foreach($anchors as $a)
            $ret[$a[2]] = "";
        return $ret;
    }
    private static function parse_code($code){
        $ret = [];
        foreach($code as $a)
            array_push($ret, $a[2]);
        return $ret;
    }

    function __construct($name, $raw){
        $sections = [];
        $format = $raw;
        $code = [];
        preg_match_all("/(\:\_([[:alpha:]]+)\|)([\s\S]*)(\:\:)/mU", $format, $sections, PREG_SET_ORDER);
        foreach($sections as $s)
            $format = str_replace($s[0], "", $format);
        preg_match_all("/(<\?php)(.*)(\?>)/m", $format, $code, PREG_SET_ORDER);
        $this->_code = self::parse_code($code);
        $anchors = [];
        preg_match_all("/(\_\:)([[:alpha:]]+)/m", $format, $anchors, PREG_SET_ORDER);
        $this->_anchors = self::parse_anchors($anchors);
        $this->_sections = self::parse_sections($sections);
        parent::__construct($name, []);
        $this->_format = $format;
    }

    function get_sections(){
        return $this->_sections;
    }

    function get_open_delim(){ return "_:"; }

    function post(){
        foreach($this->_code as $snip){
            $res = eval($snip);
            $this->_format = preg_replace("/(<\?php)$snip(\?>)/m", $res, $this->_format);
        }
        die( $this->_format);
        echo $this->assemble();
    }

    function get_data_fields() : array{
        return $this->_anchors;
    }

	function get_query_string(): string{
        return $this->_format;
    }
}

?>