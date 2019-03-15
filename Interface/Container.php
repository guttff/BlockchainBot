<?php
namespace Container;

interface Container
{
    public function add($item);
    
    public function getItem(Int $index);
    
    public function getIndex(String $name);
}

?>