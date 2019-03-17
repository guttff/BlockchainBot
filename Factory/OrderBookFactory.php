<?php
namespace Factory;

use Model\OrderBook;

// require_once 'Model/OrderBook.php';

class OrderBookFactory
{
    public static function create() {
        return new OrderBook();
    }
        
}

