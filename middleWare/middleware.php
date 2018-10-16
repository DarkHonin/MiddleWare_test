<?php

namespace App;

require_once("config/configreader.php");

$middleware = [];

function configMiddleware(){
	$mods = \CFG\readConfig("middleware");
	global $middleware;
	foreach($mods["MIDDLEWARE"] as $ID => $mod)
		$middleware[$ID] = __DIR__."/$mod";
}

function load_module($ID){
	global $middleware;
    foreach(scandir($middleware[$ID]) as $d){
        $of = strripos($d, ".php");
        if($of > 0)
            require_once($middleware[$ID]."/".$d);
	}
	if(file_exists($middleware[$ID]."/classes"))
		foreach(scandir($middleware[$ID]."/classes") as $d){
        $of = strripos($d, ".php");
        if($of > 0)
            require_once($middleware[$ID]."/classes/".$d);
    }
    $init = "$ID\\init";
    $init();
}


function modstat(){
    global $middleware;
    foreach($middleware as $m=>$p){
        printf("[%s] : %s\n", $m, $p);
    }
}

function hasParent($parent, $object){
    $aa = class_parents($object);
    $aa = array_flip($aa);
    $aa = array_pop($aa);
    return $parent == $aa;
}

?>