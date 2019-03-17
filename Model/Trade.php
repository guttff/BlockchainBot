<?php
namespace Model;

class Trade extends JsonBase
{
    public $Id;
    public $TimeStamp;
    public $Quantity;
    public $Price;
    public $Total;
    public $FillType;
    public $OrderType;
    
    
    
    public function __construct(){
        
    }
    
    
    public function expose() {
        return get_object_vars($this);
    }
    
    
    /**
     * @return $Id
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return $TimeStamp
     */
    public function getTimeStamp()
    {
        return $this->TimeStamp;
    }

    /**
     * @param $TimeStamp
     */
    public function setTimeStamp($TimeStamp)
    {
        $this->TimeStamp = $TimeStamp;
    }

    /**
     * @return $Quantity
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * @param $Quantity
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
    }

    /**
     * @return $Price
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @param $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
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
     * @param $FillType
     */
    public function setFillType($FillType)
    {
        $this->FillType = $FillType;
    }

    /**
     * @return $OrderType
     */
    public function getOrderType()
    {
        return $this->OrderType;
    }

    /**
     * @param $OrderType
     */
    public function setOrderType($OrderType)
    {
        $this->OrderType = $OrderType;
    }

}

