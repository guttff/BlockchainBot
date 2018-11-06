<?php
// namespace OrderBook;

// use JsonBase;
require_once "Utils/JsonBase.php";
require_once "Utils/Order.php";

// use Order;

class OrderBook extends JsonBase
{
    private $orderBook;
    private $orderBookMean;
    private $orderBookMedian;
    private $orderBookMode;
    private $orderBookMinimum;
    private $orderBookMaximum;
    
    function __construct($odrBk){
        $this->orderBook = array();
        
        $this->setOrderBook($odrBk);
//         $this->calculateMean();
        $this->calculateMedian();
        $this->calculateMode();
        $this->calculateMinimum();
        $this->calculateMaximum();
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    private function setOrderBook($odrBk){
        
        foreach($odrBk as $item){
            $order = new Order();
            $order->setQuantity($item['Quantity']);
            $order->setRate($item['Rate']);
            array_push($this->orderBook,$order);
            
            break;
        }
        
        
        echo "<pre>";
        echo '----------------------------------: <br/>';
        echo 'buy order book: '.count($this->orderBook).'<br/>';
//         echo json_encode($this, JSON_PRETTY_PRINT);
        echo $this->toJSON();
        echo '----------------------------------: <br/>';
        echo "</pre>";
    }
    
    function calculateMean(){
        
        foreach($this->orderBook as $order){
            $order->getQuantity();
            $order->getRate();
        }
    }
    
    function calculateMedian(){
        
    }
    
    function calculateMode(){
        
    }
    
    function calculateMinimum(){
        
    }
    
    function calculateMaximum(){
        
    }
    
    /**
     * @return mixed
     */
    public function getOrderBook()
    {
        return $this->orderBook;
    }

    /**
     * @return mixed
     */
    public function getOrderBookMean()
    {
        return $this->orderBookMean;
    }

    /**
     * @return mixed
     */
    public function getOrderBookMedian()
    {
        return $this->orderBookMedian;
    }

    /**
     * @return mixed
     */
    public function getOrderBookMode()
    {
        return $this->orderBookMode;
    }

    /**
     * @return mixed
     */
    public function getOrderBookMinimum()
    {
        return $this->orderBookMinimum;
    }

    /**
     * @return mixed
     */
    public function getOrderBookMaximum()
    {
        return $this->orderBookMaximum;
    }

    
    
    
}

?>