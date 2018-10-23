<?php

namespace AUTH;

class RegisterForm extends \User implements \FRONT\Form{

    function get_create_fields() : array{
		return ["Username"=>$this->get_col("username"), "Email"=>$this->get_col("email"), "Password"=>$this->get_col("pass")];
	}
    function get_method(){
		return "POST";
	}
    function get_token(){
		return md5($this->get_name().\App\getRealIpAddr());
	}

	function get_submit_text(){
		return "Register";
	}
    function get_action(){
		return "/register";
	}

	function validate($params){
		
	}
}

?>