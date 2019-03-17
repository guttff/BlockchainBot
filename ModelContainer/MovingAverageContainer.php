<?php
namespace ModelContainer;

use Interfaces\Container;
use Model\JsonBase;
use Factory\MovingAverageFactory;

class MovingAverageContainer extends JsonBase implements Container
{
    
    private $movingAverages;
    
    public function _construct(){
        $this->movingAverages = Array();
    }
    
    public function expose() {
        return get_object_vars($this);
    }
    
    public function add($movingAverage)
    {
        array_push($this->movingAverages,$movingAverage);
    }

    public function getIndex(String $name)
    {
        for($i=0;$i<count($this->getMovingAverages());$i++){
            $mo = MovingAverageFactory::create();
            $mo = $this->getItem($i);
            
            if($mo->getMarket() == $name)
                return $i;
        }
        
        return null;
        
    }

    public function getItem(Int $index)
    {
        return $this->getMovingAverages()[$index];
    }
    
    
    /**
     * @return multitype:
     */
    public function getMovingAverages()
    {
        return $this->movingAverages;
    }

    /**
     * @param multitype: $movingAverages
     */
    public function setMovingAverages($movingAverages)
    {
        $this->movingAverages = $movingAverages;
    }


    
    
}

