<?php
namespace Factory;

use Model\Trade;

class TradeFactory
{
    public static function create() {
        return new Trade();
    }
}

