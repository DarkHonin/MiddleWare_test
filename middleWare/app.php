<?php
namespace APP;
$app_info = \CFG\readConfig("app");

function Title(){
	global $app_info;
	echo $app_info["NAME"];
}

function Charset(){
	global $app_info;
	echo $app_info["CHARSET"];
}

?>