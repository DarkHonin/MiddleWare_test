<?php

namespace AUTH;

class LoginForm extends \User implements \FRONT\Form{

    function get_create_fields() : array{
		return ["Username"=>$this->get_col("username"), "Password"=>$this->get_col("pass")];
	}
    function get_method(){
		return "POST";
	}
    function get_token(){
		return md5($this->get_name().\App\getRealIpAddr());
	}

	function get_submit_text(){
		return "Login";
	}
    function get_action(){
		return "/login";
	}

	function validate($params){
		
	}
}

?>