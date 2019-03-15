<?php
// namespace Design;

require_once "Model/JsonBase.php";

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
    
    private $SMA;
    private $EMA;
    private $previousEMA;
    private $N_timePeriods;
    private $a_smoothingfactor;
    private $P_currPrice;
    private $marketHistory;
    private $runningTotal;
    
    
    
    public function expose() {
        return get_object_vars($this);
    }
    
    public function getSimpleMovingAverage(){
        
    }
    
    public function getExponentialMovingAverage(){
        
    }
}
?>
