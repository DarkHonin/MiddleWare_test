<?php

abstract class FRONT{
	private static $info;

	public static function init(){
		self::$info = \CFG\readConfig("frontend");
	}

	public static function render_form($form){
        $data = [
            "fields" => $form->get_create_fields(),
            "method" => $form->get_method(),
            "token" => $form->get_token(),
            "action" => $form->get_action(),
            "submit" => $form->get_submit_text()
        ];
        (new \FRONT\Runner("app/parts/form/form.php", $data))->build();
    }
}

?>