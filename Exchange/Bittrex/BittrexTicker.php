<?php

namespace Exchange\Bittrex;

use Model\JsonBase;


// require_once "Model/JsonBase.php";

class BittrexTicker extends JsonBase
{
    private $Bid;
    private $Ask;
    private $Last;
    
    public function expose() {
        return get_object_vars($this);
    }
    
    /**
     * @return $Bid
     */
    public function getBid()
    {
        return $this->Bid;
    }

    /**
     * @param $Bid
     */
    public function setBid($Bid)
    {
        $this->Bid = number_format($Bid, 8);
    }

    /**
     * @return $Ask
     */
    public function getAsk()
    {
        return $this->Ask;
    }

    /**
     * @param $Ask
     */
    public function setAsk($Ask)
    {
        $this->Ask = number_format($Ask, 8);
    }

    /**
     * @return $Last
     */
    public function getLast()
    {
        return $this->Last;
    }

    /**
     * @param $Last
     */
    public function setLast($Last)
    {
        $this->Last = number_format($Last, 8);
    }

    
}
?>
