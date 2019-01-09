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
        
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    private function setOrderBook($odrBk){
        
        $quantityTotal  = 0;
        $rateTotal      = 0;
        $totalItems     = 0;
        
        $quantityMin    = 0;
        $rateMin        = 0;
        
        $quantityMax    = 0;
        $rateMax        = 0;
        
        $rateArray      = Array();
        $quantityArray  = Array();
        
        foreach($odrBk as $item){
            $order = new Order();
            $order->setQuantity($item['Quantity']);
            $order->setRate(number_format($item['Rate'],8, ".", " "));
            array_push($this->orderBook,$order);
            
            
            array_push($rateArray,$order->getRate());
            array_push($quantityArray,$order->getQuantity());
            
            $quantityTotal  += $order->getQuantity();
            $rateTotal      += $order->getRate();
            
            $quantityMin = ($totalItems == 0) ? $order->getQuantity() : $quantityMin;
            $quantityMin = ($quantityMin > $order->getQuantity()) ? $order->getQuantity() : $quantityMin;
            $rateMin = ($totalItems == 0) ? $order->getRate() : $rateMin;
            $rateMin = ($rateMin > $order->getRate()) ? $order->getRate() : $rateMin;
            
            $quantityMax = ($totalItems == 0) ? $order->getQuantity() : $quantityMax;
            $quantityMax = ($quantityMax < $order->getQuantity()) ? $order->getQuantity() : $quantityMax;
            $rateMax = ($totalItems == 0) ? $order->getRate() : $rateMax;
            $rateMax = ($rateMax < $order->getRate()) ? $order->getRate() : $rateMax;
            
            $totalItems++;
        }
        
        
        $this->calculateMean($rateTotal, $quantityTotal, $totalItems);
        $this->calculateMedian($rateArray, $quantityArray, $totalItems);
        $this->calculateMinimum($rateMin, $quantityMin);
        $this->calculateMaximum($rateMax, $quantityMax);
        
        $this->calculateMode();
    }
    
    function calculateMean($rateTotal, $quantityTotal, $totalItems){
        
        $order = new Order();
        $order->setQuantity(number_format(($quantityTotal/$totalItems), 2, '.', ''));
        $order->setRate(number_format(($rateTotal/$totalItems),8, '.', ''));
        
        $this->orderBookMean = $order;
    }
    
    function calculateMedian($rateArray, $quantityArray, $totalItems){
        
        $order = new Order();
        $order->setQuantity(number_format($this->median($totalItems, $quantityArray), 2, '.', ''));
        $order->setRate(number_format($this->median($totalItems, $rateArray),8, '.', ''));
        
        $this->orderBookMedian = $order;
    }
    
    /* TODO: */
    function calculateMode(){
        
    }
    
    function calculateMinimum($rateMin, $quantityMin){
        
        $order = new Order();
        $order->setQuantity(number_format($quantityMin, 2, '.', ''));
        $order->setRate(number_format($rateMin,8, '.', ''));
        
        $this->orderBookMinimum = $order;
    }
    
    function calculateMaximum($rateMax, $quantityMax){
        
        $order = new Order();
        $order->setQuantity(number_format($quantityMax, 2, '.', ''));
        $order->setRate(number_format($rateMax,8, '.', ''));
        
        $this->orderBookMaximum = $order;
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