<?php


namespace FRONT;
require_once("Runner.class.php");

interface Form{
    function get_create_fields() : array;
    function get_method();
    function get_token();
    function validate($params);
}

?>