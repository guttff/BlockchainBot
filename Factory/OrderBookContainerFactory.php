<?php
namespace Factory;

use ModelContainer\OrderBookContainer;

// require_once 'ModelContainer/OrderBooks.php';

class OrderBookContainerFactory
{
    public static function create() {
        return new OrderBookContainer();
    }
}

