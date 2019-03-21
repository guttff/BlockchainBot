<?php
namespace Exceptions;

class ExceptionMapper //extends Exception 
{
    public static function MissingException($message){
        echo "Missing : ". $message; 
    }
}

