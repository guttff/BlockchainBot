<?php

Class MarketMaker{
    
    function isUpTrend($marketHistory){
        $isUpTrend = false;
        
        return $isUpTrend;
    }
    
    function getSpreadPercent($bid, $ask, $price){
        return number_format((($bid - $ask)/$price),4);
    }
}
?>