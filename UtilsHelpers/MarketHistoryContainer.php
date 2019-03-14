<?php
// namespace UtilsHelpers;


require_once "Utils/JsonBase.php";
require_once "Utils/MarketHistory.php";

class MarketHistoryContainer extends JsonBase
{
    private $marketHistory;
    private $marketHistoryMean;
    private $marketHistoryMedian;
    private $marketHistoryMode;
    private $marketHistoryMinimum;
    private $marketHistoryMaximum;
    private $totalItems;
    
    
    function __construct($mrktHistory){
        $this->marketHistory = array();
        
        $this->setMarketHistory($mrktHistory);
        
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    
    private function setMarketHistory($mrktHistory){
        
        $quantityTotal  = 0;
        $priceTotal      = 0;
        $totalItems     = 0;
        
        
        $priceArray      = Array();
        $quantityArray  = Array();
        
        foreach($mrktHistory as $item){
            $marketHistory = new MarketHistory();
            $marketHistory->setId($item['Id']);
            $marketHistory->setTimeStamp($item['TimeStamp']);
            $marketHistory->setQuantity($item['Quantity']);
            $marketHistory->setPrice(number_format($item['Price'],8, ".", " "));
            $marketHistory->setTotal($item['Total']);
            $marketHistory->setFillType($item['FillType']);
            $marketHistory->setOrderType($item['OrderType']);
            array_push($this->marketHistory,$marketHistory);
            
            
            array_push($priceArray,$marketHistory->getPrice());
            array_push($quantityArray,$marketHistory->getQuantity());
            
            $quantityTotal  += $marketHistory->getQuantity();
            $priceTotal      += $marketHistory->getPrice();
            
            if($totalItems == 0){
                $this->setMarketHistoryMinimum($marketHistory);
                $this->setMarketHistoryMaximum($marketHistory);
            }
               
            if($this->getMarketHistoryMinimum()->getPrice() > $marketHistory->getPrice())
                $this->setMarketHistoryMinimum($marketHistory);
                    
            if($this->getMarketHistoryMaximum()->getPrice() < $marketHistory->getPrice())
                $this->setMarketHistoryMaximum($marketHistory);
            
                    
            $totalItems++;
        }
        
        
        $this->calculateMean($priceTotal, $quantityTotal, $totalItems);
        $this->calculateMedian($priceArray, $quantityArray, $totalItems);
        $this->setTotalItems($totalItems);
        
        $this->calculateMode();
    }
    
    function calculateMean($priceTotal, $quantityTotal, $totalItems){
        
        $marketHistory = new MarketHistory();
        $marketHistory->setQuantity(number_format(($quantityTotal/$totalItems), 2, '.', ''));
        $marketHistory->setPrice(number_format(($priceTotal/$totalItems),8, '.', ''));
        
        $this->marketHistoryMean = $marketHistory;
    }
    
    function calculateMedian($priceArray, $quantityArray, $totalItems){
        
        $marketHistory = new MarketHistory();
        $marketHistory->setQuantity(number_format($this->median($totalItems, $quantityArray), 2, '.', ''));
        $marketHistory->setPrice(number_format($this->median($totalItems, $priceArray),8, '.', ''));
        
        $this->marketHistoryMedian = $marketHistory;
    }
    
    /* TODO: */
    function calculateMode(){
        
    }
    
    function calculateMinimum($priceMin, $quantityMin){
        
        $marketHistory = new MarketHistory();
        $marketHistory->setQuantity(number_format($quantityMin, 2, '.', ''));
        $marketHistory->setPrice(number_format($priceMin,8, '.', ''));
        
        $this->marketHistoryMinimum = $marketHistory;
    }
    
    function calculateMaximum($priceMax, $quantityMax){
        
        $marketHistory = new MarketHistory();
        $marketHistory->setQuantity(number_format($quantityMax, 2, '.', ''));
        $marketHistory->setPrice(number_format($priceMax,8, '.', ''));
        
        $this->marketHistoryMaximum = $marketHistory;
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
     * @return $marketHistory:
     */
    public function getMarketHistory()
    {
        return $this->marketHistory;
    }

    
    
    

    
    
    
}

