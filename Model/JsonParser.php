<?php
namespace Model;

class JsonParser
{
    public static function expose($obj) {
        return get_object_vars($obj);
    }
    
    public static function toJSON($obj){
        return json_encode($obj, JSON_PRETTY_PRINT);
    }
}

