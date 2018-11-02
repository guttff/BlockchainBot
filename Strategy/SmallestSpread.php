<?php
// namespace Strategy;

require_once "Utils/JsonBase.php";

class SmallestSpread extends JsonBase
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
     * @return mixed
     */
    public function getSpreadPercent()
    {
        return $this->spreadPercent;
    }

    /**
     * @param mixed $spreadPercent
     */
    public function setSpreadPercent($spreadPercent)
    {
        $this->spreadPercent = $spreadPercent;
    }

    /**
     * @return mixed
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * @param mixed $market
     */
    public function setMarket($market)
    {
        $this->market = $market;
    }

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param mixed $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * @return mixed
     */
    public function getCost_USD()
    {
        return $this->cost_USD;
    }

    /**
     * @param mixed $cost_USD
     */
    public function setCost_USD($cost_USD)
    {
        $this->cost_USD = $cost_USD;
    }

    /**
     * @return mixed
     */
    public function getCost_BTC()
    {
        return $this->cost_BTC;
    }

    /**
     * @param mixed $cost_BTC
     */
    public function setCost_BTC($cost_BTC)
    {
        $this->cost_BTC = $cost_BTC;
    }

}

?>

