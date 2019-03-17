<?php
namespace Model;

// require_once "Model/JsonBase.php";

class MovingAverage extends JsonBase
{
    
    #	SMA = simple moving average
    #	SMA = mean of values over time period
    # 	For example, to calculate a basic 10-day moving average
    #	you would add up the closing prices from the past 10 days
    # 	and then divide the result by 10.
    
    #	EMA = (P * a) + (previous EMA * (1-a))
    #	P = current price
    #	a = smoothing factor = 2 / (1 + N)
    # 	N = number of time periods
    #	use SMA when previous EMA is unknown
    
    private $market;
    private $SimpleMovingAverage;
    private $ExponentialMovingAverage;
    private $previousEMA;
    private $N_timePeriods;
    private $a_smoothingfactor;
    private $P_currPrice;
    private $marketHistory;
    private $runningTotal;
    private $movingAverage;
    
    public function _construct()
    {
        
    }
    
    
    public function expose() {
        return get_object_vars($this);
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
    public function getSimpleMovingAverage()
    {
        return $this->SimpleMovingAverage;
    }

    /**
     * @param mixed $SimpleMovingAverage
     */
    public function setSimpleMovingAverage($SimpleMovingAverage)
    {
        $this->SimpleMovingAverage = $SimpleMovingAverage;
    }

    /**
     * @return mixed
     */
    public function getExponentialMovingAverage()
    {
        return $this->ExponentialMovingAverage;
    }

    /**
     * @param mixed $ExponentialMovingAverage
     */
    public function setExponentialMovingAverage($ExponentialMovingAverage)
    {
        $this->ExponentialMovingAverage = $ExponentialMovingAverage;
    }

    /**
     * @return mixed
     */
    public function getPreviousEMA()
    {
        return $this->previousEMA;
    }

    /**
     * @param mixed $previousEMA
     */
    public function setPreviousEMA($previousEMA)
    {
        $this->previousEMA = $previousEMA;
    }

    /**
     * @return mixed
     */
    public function getN_timePeriods()
    {
        return $this->N_timePeriods;
    }

    /**
     * @param mixed $N_timePeriods
     */
    public function setN_timePeriods($N_timePeriods)
    {
        $this->N_timePeriods = $N_timePeriods;
    }

    /**
     * @return mixed
     */
    public function getA_smoothingfactor()
    {
        return $this->a_smoothingfactor;
    }

    /**
     * @param mixed $a_smoothingfactor
     */
    public function setA_smoothingfactor($a_smoothingfactor)
    {
        $this->a_smoothingfactor = $a_smoothingfactor;
    }

    /**
     * @return mixed
     */
    public function getP_currPrice()
    {
        return $this->P_currPrice;
    }

    /**
     * @param mixed $P_currPrice
     */
    public function setP_currPrice($P_currPrice)
    {
        $this->P_currPrice = $P_currPrice;
    }

    /**
     * @return mixed
     */
    public function getMarketHistory()
    {
        return $this->marketHistory;
    }

    /**
     * @param mixed $marketHistory
     */
    public function setMarketHistory($marketHistory)
    {
        $this->marketHistory = $marketHistory;
    }

    /**
     * @return mixed
     */
    public function getRunningTotal()
    {
        return $this->runningTotal;
    }

    /**
     * @param mixed $runningTotal
     */
    public function setRunningTotal($runningTotal)
    {
        $this->runningTotal = $runningTotal;
    }
    /**
     * @return mixed
     */
    public function getMovingAverage()
    {
        return $this->movingAverage;
    }

    /**
     * @param mixed $movingAverage
     */
    public function setMovingAverage($movingAverage)
    {
        $this->movingAverage = $movingAverage;
    }



    

}
?>
