<?php

namespace CFG;

function readConfig($file){
    return json_decode(file_get_contents(__DIR__."/".$file.".json"), true);
}

?>