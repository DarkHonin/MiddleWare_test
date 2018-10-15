<?php

namespace mod;

$modules = [];

function load_module($dir){
    foreach(scandir($dir) as $d){
        $of = strripos($d, ".php");
        if($of > 0)
            require_once($dir."/".$d);
    }
}

function register_mod($modname, $path){
    global $modules;

    $modules[$modname] = $path;
}

function modstat(){
    global $modules;
    foreach($modules as $m=>$p){
        printf("[%s] : %s\n", $m, $p);
    }
}

?>