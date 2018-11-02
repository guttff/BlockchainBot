<?php
// namespace Bittrex;

require_once "Utils/JsonBase.php";

class BittrexTicker extends JsonBase
{
    private $Bid;
    private $Ask;
    private $Last;
    
    public function expose() {
        return get_object_vars($this);
    }
    
    /**
     * @return mixed
     */
    public function getBid()
    {
        return $this->Bid;
    }

    /**
     * @param mixed $Bid
     */
    public function setBid($Bid)
    {
        $this->Bid = number_format($Bid, 8);
    }

    /**
     * @return mixed
     */
    public function getAsk()
    {
        return $this->Ask;
    }

    /**
     * @param mixed $Ask
     */
    public function setAsk($Ask)
    {
        $this->Ask = number_format($Ask, 8);
    }

    /**
     * @return mixed
     */
    public function getLast()
    {
        return $this->Last;
    }

    /**
     * @param mixed $Last
     */
    public function setLast($Last)
    {
        $this->Last = number_format($Last, 8);
    }

    
}
?>
