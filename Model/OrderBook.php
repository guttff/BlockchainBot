<?php
// namespace OrderBook;

// use JsonBase;
require_once "Model/JsonBase.php";
require_once "Model/BaseOrder.php";

// use Order;

class OrderBook extends JsonBase
{
    private $market;
    private $type;
    private $orderBook;
    private $orderBookMean;
    private $orderBookMedian;
    private $orderBookMode;
    private $orderBookMinimum;
    private $orderBookMaximum;
    
    function __construct($odrBk){
        $this->orderBook = array();
        
        $this->setOrderBook($odrBk);
        
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    private function setOrderBook($odrBk){
        
        $quantityTotal  = 0;
        $rateTotal      = 0;
        $totalItems     = 0;
        
        $rateArray      = Array();
        $quantityArray  = Array();
        
        foreach($odrBk as $item){
            $order = new BaseOrder();
            $order->setQuantity($item['Quantity']);
            $order->setRate(number_format($item['Rate'],8, ".", " "));
            array_push($this->orderBook,$order);
            
            
            array_push($rateArray,$order->getRate());
            array_push($quantityArray,$order->getQuantity());
            
            $quantityTotal  += $order->getQuantity();
            $rateTotal      += $order->getRate();
                        
            
            if($totalItems == 0){
                $this->setOrderBookMinimum($order);
                $this->setOrderBookMaximum($order);
            }
            
            if($this->getOrderBookMinimum()->getRate() > $order->getRate())
                $this->setOrderBookMinimum($order);
                
            if($this->getOrderBookMaximum()->getRate() < $order->getRate())
                $this->setOrderBookMaximum($order);
                    
            
            
            $totalItems++;
        }
        
        
        $this->calculateMean($rateTotal, $quantityTotal, $totalItems);
        $this->calculateMedian($rateArray, $quantityArray, $totalItems);
        
        $this->calculateMode();
    }
    
    function calculateMean($rateTotal, $quantityTotal, $totalItems){
        
        $order = new BaseOrder();
        $order->setQuantity(number_format(($quantityTotal/$totalItems), 2, '.', ''));
        $order->setRate(number_format(($rateTotal/$totalItems),8, '.', ''));
        
        $this->orderBookMean = $order;
    }
    
    function calculateMedian($rateArray, $quantityArray, $totalItems){
        
        $order = new BaseOrder();
        $order->setQuantity(number_format($this->median($totalItems, $quantityArray), 2, '.', ''));
        $order->setRate(number_format($this->median($totalItems, $rateArray),8, '.', ''));
        
        $this->orderBookMedian = $order;
    }
    
    /* TODO: */
    function calculateMode(){
        
    }
    
    
    function median($n, $x) {
        if(count($x) == 0)
            return 0;
        
        $temp = 0;
        $i = $j = 0;
        // the following two loops sort the array x in ascending order
        for($i=0; $i<$n-1; $i++) {
            for($j=$i+1; $j<$n; $j++) {
                if($x[$j] < $x[$i]) {
                    // swap elements
                    $temp = $x[$i];
                    $x[$i] = $x[$j];
                    $x[$j] = $temp;
                }
            }
        }
        
        if($n%2==0) {
            // if there is an even number of elements, return mean of the two elements in the middle
            return(($x[$n/2] + $x[$n/2 - 1]) / 2.0);
        } else {
            // else return the element in the middle
            return $x[$n/2];
        }
    }
    
    
    
    /**
     * @return $market
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * @param $market
     */
    public function setMarket($market)
    {
        $this->market = $market;
    }

    /**
     * @return $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return BaseOrder
     */
    public function getOrderBookMinimum()
    {
        return $this->orderBookMinimum;
    }

    /**
     * @param BaseOrder $orderBookMinimum
     */
    public function setOrderBookMinimum($orderBookMinimum)
    {
        $this->orderBookMinimum = $orderBookMinimum;
    }

    /**
     * @return BaseOrder
     */
    public function getOrderBookMaximum()
    {
        return $this->orderBookMaximum;
    }

    /**
     * @param BaseOrder $orderBookMaximum
     */
    public function setOrderBookMaximum($orderBookMaximum)
    {
        $this->orderBookMaximum = $orderBookMaximum;
    }


    
    
    
}

?>