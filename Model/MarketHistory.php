<?php
namespace Model;

use Factory\TradeFactory;

// require_once "Model/JsonBase.php";

class MarketHistory extends JsonBase
{
    
    public $market;
    public $marketHistory;
    public $marketHistoryMean;
    public $marketHistoryMedian;
    public $marketHistoryMode;
    public $marketHistoryMinimum;
    public $marketHistoryMaximum;
    public $totalItems;
    
    
    
    public function __construct(){
        $this->marketHistory = array();
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    
    public function setMarketHistory($mrktHistory){
        $this->marketHistory = $mrktHistory;
    }
    
    public function build($mrktHistory){
        
        $quantityTotal  = 0;
        $priceTotal      = 0;
        $totalItems     = 0;
        
        
        $priceArray      = Array();
        $quantityArray  = Array();
        
        foreach($mrktHistory as $item){
            $trade = TradeFactory::create();
            $trade->setId($item['Id']);
            $trade->setTimeStamp($item['TimeStamp']);
            $trade->setQuantity($item['Quantity']);
            $trade->setPrice(number_format($item['Price'],8, ".", " "));
            $trade->setTotal($item['Total']);
            $trade->setFillType($item['FillType']);
            $trade->setOrderType($item['OrderType']);
            array_push($this->marketHistory,$trade);
            
            
            array_push($priceArray,$trade->getPrice());
            array_push($quantityArray,$trade->getQuantity());
            
            $quantityTotal  += $trade->getQuantity();
            $priceTotal      += $trade->getPrice();
            
            if($totalItems == 0){
                $this->setMarketHistoryMinimum($trade);
                $this->setMarketHistoryMaximum($trade);
            }
            
            if($this->getMarketHistoryMinimum()->getPrice() > $trade->getPrice())
                $this->setMarketHistoryMinimum($trade);
                
            if($this->getMarketHistoryMaximum()->getPrice() < $trade->getPrice())
                $this->setMarketHistoryMaximum($trade);
            
            $totalItems++;
        }
        
        
        $this->calculateMean($priceTotal, $quantityTotal, $totalItems);
        $this->calculateMedian($priceArray, $quantityArray, $totalItems);
        $this->setTotalItems($totalItems);
        
        $this->calculateMode();
    }
    
    function calculateMean($priceTotal, $quantityTotal, $totalItems){
        
        $trade = TradeFactory::create();
        $trade->setQuantity(number_format(($quantityTotal/$totalItems), 2, '.', ''));
        $trade->setPrice(number_format(($priceTotal/$totalItems),8, '.', ''));
        
        $this->marketHistoryMean = $trade;
    }
    
    function calculateMedian($priceArray, $quantityArray, $totalItems){
        
        $trade = TradeFactory::create();
        $trade->setQuantity(number_format($this->median($totalItems, $quantityArray), 2, '.', ''));
        $trade->setPrice(number_format($this->median($totalItems, $priceArray),8, '.', ''));
        
        $this->marketHistoryMedian = $trade;
    }
    
    /* TODO: */
    function calculateMode(){
        
    }
    
    function calculateMinimum($priceMin, $quantityMin){
        
        $trade = TradeFactory::create();
        $trade->setQuantity(number_format($quantityMin, 2, '.', ''));
        $trade->setPrice(number_format($priceMin,8, '.', ''));
        
        $this->marketHistoryMinimum = $trade;
    }
    
    function calculateMaximum($priceMax, $quantityMax){
        
        $trade = TradeFactory::create();
        $trade->setQuantity(number_format($quantityMax, 2, '.', ''));
        $trade->setPrice(number_format($priceMax,8, '.', ''));
        
        $this->marketHistoryMaximum = $trade;
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
     * @return $marketHistoryMean
     */
    public function getMarketHistoryMean()
    {
        return $this->marketHistoryMean;
    }
    
    /**
     * @param $marketHistoryMean
     */
    public function setMarketHistoryMean($marketHistoryMean)
    {
        $this->marketHistoryMean = $marketHistoryMean;
    }
    
    /**
     * @return $marketHistoryMedian
     */
    public function getMarketHistoryMedian()
    {
        return $this->marketHistoryMedian;
    }
    
    /**
     * @param $marketHistoryMedian
     */
    public function setMarketHistoryMedian($marketHistoryMedian)
    {
        $this->marketHistoryMedian = $marketHistoryMedian;
    }
    
    /**
     * @return $marketHistoryMode
     */
    public function getMarketHistoryMode()
    {
        return $this->marketHistoryMode;
    }
    
    /**
     * @param $marketHistoryMode
     */
    public function setMarketHistoryMode($marketHistoryMode)
    {
        $this->marketHistoryMode = $marketHistoryMode;
    }
    
    /**
     * @return $marketHistoryMinimum
     */
    public function getMarketHistoryMinimum()
    {
        return $this->marketHistoryMinimum;
    }
    
    /**
     * @param $marketHistoryMinimum
     */
    public function setMarketHistoryMinimum($marketHistoryMinimum)
    {
        $this->marketHistoryMinimum = $marketHistoryMinimum;
    }
    
    /**
     * @return $marketHistoryMaximum
     */
    public function getMarketHistoryMaximum()
    {
        return $this->marketHistoryMaximum;
    }
    
    /**
     * @param $marketHistoryMaximum
     */
    public function setMarketHistoryMaximum($marketHistoryMaximum)
    {
        $this->marketHistoryMaximum = $marketHistoryMaximum;
    }
    
    /**
     * @return $totalItems
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }
    
    /**
     * @param $totalItems
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
    }
    
    /**
     * @return Trade[]
     */
    public function getMarketHistory()
    {
        return $this->marketHistory;
    }
    
    
    
    
}

?>

