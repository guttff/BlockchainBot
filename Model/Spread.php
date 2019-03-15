<?php
// namespace SmallestSpread;

// use JsonBase;
require_once "Model/JsonBase.php";


class Spread extends JsonBase
{
    private $spreadPercent;
    private $market;
    private $symbol;
    private $cost_USD;
    private $cost_BTC;
    
    public function expose() {
        return get_object_vars($this);
    }
    
    /**
     * @return $spreadPercent
     */
    public function getSpreadPercent()
    {
        return $this->spreadPercent;
    }

    /**
     * @param $spreadPercent
     */
    public function setSpreadPercent($spreadPercent)
    {
        $this->spreadPercent = $spreadPercent;
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
     * @return $symbol
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * @return $cost_USD
     */
    public function getCost_USD()
    {
        return $this->cost_USD;
    }

    /**
     * @param $cost_USD
     */
    public function setCost_USD($cost_USD)
    {
        $this->cost_USD = $cost_USD;
    }

    /**
     * @return $cost_BTC
     */
    public function getCost_BTC()
    {
        return $this->cost_BTC;
    }

    /**
     * @param $cost_BTC
     */
    public function setCost_BTC($cost_BTC)
    {
        $this->cost_BTC = $cost_BTC;
    }

}

?>

