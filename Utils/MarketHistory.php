<?php
// namespace Utils;

require_once "Utils/JsonBase.php";

class MarketHistory extends JsonBase
{
    public $Id;
    public $TimeStamp;
    public $Quantity;
    public $Price;
    public $Total;
    public $FillType;
    public $OrderType;
    
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return $this->TimeStamp;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->Total;
    }

    /**
     * @param mixed $Total
     */
    public function setTotal($Total)
    {
        $this->Total = $Total;
    }

    /**
     * @return mixed
     */
    public function getFillType()
    {
        return $this->FillType;
    }

    /**
     * @return mixed
     */
    public function getOrderType()
    {
        return $this->OrderType;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @param mixed $TimeStamp
     */
    public function setTimeStamp($TimeStamp)
    {
        $this->TimeStamp = $TimeStamp;
    }

    /**
     * @param mixed $Quantity
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
    }

    /**
     * @param mixed $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @param mixed $FillType
     */
    public function setFillType($FillType)
    {
        $this->FillType = $FillType;
    }

    /**
     * @param mixed $OrderType
     */
    public function setOrderType($OrderType)
    {
        $this->OrderType = $OrderType;
    }

    
    
}

?>

