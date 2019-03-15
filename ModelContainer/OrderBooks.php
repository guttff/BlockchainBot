<?php
use Container\Container;

require_once 'Interface/Container.php';
require_once 'Model/JsonBase.php';
require_once 'Model/OrderBook.php';

class OrderBooks extends JsonBase implements Container
{
    private $orderBooks;
    
    
    function __construct(){
        $this->orderBooks = array();
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    
    public function add($orderBook) {
        
        array_push($this->orderBooks,$orderBook);
    }
    
    
    public function getIndex(String $name) {
        
        for($i=0;$i<count($this->getOrderBooks());$i++){
            $o = $this->getItem($i);
            
        }
        
    }
    
    
    public function getItem(Int $index) {
        
        return $this->getOrderBooks()[$index];
    }
    
    
    /**
     * @return $orderBooks:
     */
    public function getOrderBooks()
    {
        return $this->orderBooks;
    }

    
    
}

?>