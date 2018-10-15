<?php

namespace DB;

\mod\register_mod("Database", "DB");

function create_db(){
    $cfg = \CFG\readConfig("database");
    return new Database($cfg);
}

function create_query($db){

}

?>