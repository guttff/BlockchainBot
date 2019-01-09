<?php
// namespace Utils;

class Compare
{
    public function isGreatherOrEqual($a, $b){
        
        $a = (float) str_replace(',', '', $a);
        $b = (float) str_replace(',', '', $b);
        
        return (($a >= $b) == 1) ? true : false;
        
    }
    
    public function isGreatherThan($a, $b){
        
        $a = (float) str_replace(',', '', $a);
        $b = (float) str_replace(',', '', $b);
        
        return (($a > $b) == 1) ? true : false;
        
    }
    
    public function isLessOrEqual($a, $b){
        
        $a = (float) str_replace(',', '', $a);
        $b = (float) str_replace(',', '', $b);
        
        return (($a <= $b) == 1) ? true : false;
        
    }
    
    public function isLessThan($a, $b){
        
        $a = (float) str_replace(',', '', $a);
        $b = (float) str_replace(',', '', $b);
        
        return (($a < $b) == 1) ? true : false;
        
    }
    
    public function isEqual($a, $b){
        
        $a = (float) str_replace(',', '', $a);
        $b = (float) str_replace(',', '', $b);
        
        return (($a == $b) == 1) ? true : false;
        
    }
    
    function getDecimalPart($floatNum) {
        return abs($floatNum - intval($floatNum));
    }
    
}

?>
