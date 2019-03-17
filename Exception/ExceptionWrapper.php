<?php
namespace Exception;

class ExceptionWrapper
{
    public static function MissingException($message){
        echo "Missing : ". $message; 
    }
}

