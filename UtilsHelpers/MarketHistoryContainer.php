<?php
// namespace UtilsHelpers;


require_once "Utils/JsonBase.php";

class MarketHistoryContainer extends JsonBase
{
    private $marketHistory;
    private $marketHistoryMean;
    private $marketHistoryMedian;
    private $marketHistoryMode;
    private $marketHistoryMinimum;
    private $marketHistoryMaximum;
    
    function __construct($marketHistory){
        $this->marketHistory = array();
        
        $this->setMarketHistory($marketHistory);
        
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    
    
    
    /**
     * @return multitype:
     */
    public function getMarketHistory()
    {
        return $this->marketHistory;
    }

    /**
     * @return mixed
     */
    public function getMarketHistoryMean()
    {
        return $this->marketHistoryMean;
    }

    /**
     * @return mixed
     */
    public function getMarketHistoryMedian()
    {
        return $this->marketHistoryMedian;
    }

    /**
     * @return mixed
     */
    public function getMarketHistoryMode()
    {
        return $this->marketHistoryMode;
    }

    /**
     * @return mixed
     */
    public function getMarketHistoryMinimum()
    {
        return $this->marketHistoryMinimum;
    }

    /**
     * @return mixed
     */
    public function getMarketHistoryMaximum()
    {
        return $this->marketHistoryMaximum;
    }

    
    
    
}

