<?php
namespace Factory;

use Model\MovingAverage;

class MovingAverageFactory
{
    public static function create() {
        return new MovingAverage();
    }
}

