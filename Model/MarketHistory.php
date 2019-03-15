<?php
// namespace Utils;

require_once "Model/JsonBase.php";

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
     * @return $Id
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @return $TimeStamp
     */
    public function getTimeStamp()
    {
        return $this->TimeStamp;
    }

    /**
     * @return $Quantity
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * @return $Price
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @return $Total
     */
    public function getTotal()
    {
        return $this->Total;
    }

    /**
     * @param $Total
     */
    public function setTotal($Total)
    {
        $this->Total = $Total;
    }

    /**
     * @return $FillType
     */
    public function getFillType()
    {
        return $this->FillType;
    }

    /**
     * @return $OrderType
     */
    public function getOrderType()
    {
        return $this->OrderType;
    }

    /**
     * @param $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @param $TimeStamp
     */
    public function setTimeStamp($TimeStamp)
    {
        $this->TimeStamp = $TimeStamp;
    }

    /**
     * @param $Quantity
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
    }

    /**
     * @param $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @param $FillType
     */
    public function setFillType($FillType)
    {
        $this->FillType = $FillType;
    }

    /**
     * @param $OrderType
     */
    public function setOrderType($OrderType)
    {
        $this->OrderType = $OrderType;
    }

    
    
}

?>

