<?php
namespace App;
$app_info = \CFG\readConfig("app");

function Title(){
	global $app_info;
	echo $app_info["NAME"];
}

function Charset(){
	global $app_info;
	echo $app_info["CHARSET"];
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>