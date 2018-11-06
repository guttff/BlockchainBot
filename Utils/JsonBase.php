<?php
// namespace JsonBase;

class JsonBase
{
    public function toJSON(){
        return json_encode($this->expose(), JSON_PRETTY_PRINT);
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
}
?>
