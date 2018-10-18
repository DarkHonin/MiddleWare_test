<?php

namespace FRONT;

abstract class Form{
    abstract function get_field_ids():array;
    abstract function get_field_descriptors():DataObject;
    abstract function get_method();
    abstract function get_token();

    static function render(Form $f){
        $data = [
            "method" => $f->get_method(),
            "token" => $f->get_token()
        ];
        FRONT::stitch("form/wrapper", $data);
    }
}

?>