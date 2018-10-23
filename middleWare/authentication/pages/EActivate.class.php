<?php
require_once("ELogin.class.php");
class EActivate extends ELogin{

	static function get_ID(){
		return "/activate";
	}

	function render(){

	}
	
	function get($params){
        if(!$params['token'])
            \ACCESS\redirect("/error", "message='Activation failed'");
        $c = "\\AUTH\\LoginForm";
        $form = new $c();
        $form = $form->select("token")->where("token='{$params['token']}'")->send();
        if(empty($form))
            \ACCESS\redirect("/error", "message='Activation failed'");
        $form = $form[0];
        $form->active = 1;
        if($form->update()->send())
            \ACCESS\redirect("/login");
        \ACCESS\redirect("/error", "message='Activation failed'");
	}
}

?>