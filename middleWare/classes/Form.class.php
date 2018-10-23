<?php


namespace FRONT;

interface Form{
    function get_create_fields() : array;
    function get_method();
    function get_token();
    function validate($params);
    function get_submit_text();
    function get_action();
}

?>