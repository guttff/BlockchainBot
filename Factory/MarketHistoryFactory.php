<?php
namespace Factory;

use Model\MarketHistory;

class MarketHistoryFactory
{
    public static function create() {
        return new MarketHistory();
    }
}

