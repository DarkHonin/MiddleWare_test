<?php
namespace App;

final class Middleware{
    static $classes = [];

    public static final function registerClass($class){
        self::$classes[$id] = $class;
    }

    public static final function getClass($id){
        return self::$classes[$id];
    }
}

?>