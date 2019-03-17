<?php
namespace Factory;

use ModelContainer\MarketHistoryContainer;

class MarketHistoryContainerFactory
{
    public static function create()
    {
        return new MarketHistoryContainer();
    }
}

