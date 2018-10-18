<?php

namespace App;

require_once("config/configreader.php");
require_once(__DIR__."/app.php");

$middleware = [];

function configMiddleware(){
	$mods = \CFG\readConfig("middleware");
	global $middleware;
	foreach($mods["MIDDLEWARE"] as $ID => $mod)
        $middleware[$ID] = __DIR__."/$mod";
    load_files(__DIR__."/classes");
}

function load_module($ID){
    global $middleware;
    load_files($middleware[$ID]);
    if(file_exists($middleware[$ID]."/classes"))
        load_files($middleware[$ID]."/classes");
    $init = "$ID\\init";
    $init();
}

function load_files($dir, $callback=null){
    foreach(scandir($dir) as $d){
        $of = strripos($d, ".php");
        if($of > 0){
            require_once($dir."/".$d);
            if($callback)
                $callback($d);
        }
	}
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