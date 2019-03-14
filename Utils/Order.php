<?php
// include "BaseOrder.php";

require_once "Utils/BaseOrder.php";

class Order extends BaseOrder
{
    
    private $market;            // BTC-XRP
    private $time;              // time in UTC
    private $fillType; 	        // partial || Full
    private $OrderType;		    // buy || sell
    private $filledAmount;
    
    
    
    
    
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
     * @return $time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return $fillType
     */
    public function getFillType()
    {
        return $this->fillType;
    }

    /**
     * @param $fillType
     */
    public function setFillType($fillType)
    {
        $this->fillType = $fillType;
    }

    /**
     * @return $OrderType
     */
    public function getOrderType()
    {
        return $this->OrderType;
    }

    /**
     * @param $OrderType
     */
    public function setOrderType($OrderType)
    {
        $this->OrderType = $OrderType;
    }

    /**
     * @return $filledAmount
     */
    public function getFilledAmount()
    {
        return $this->filledAmount;
    }

    /**
     * @param $filledAmount
     */
    public function setFilledAmount($filledAmount)
    {
        $this->filledAmount = $filledAmount;
    }

    
    
}

?>