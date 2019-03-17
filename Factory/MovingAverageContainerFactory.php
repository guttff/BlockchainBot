<?php
namespace Factory;

use ModelContainer\MovingAverageContainer;

class MovingAverageContainerFactory
{
    public function create()
    {
        return new MovingAverageContainer();
    }
}

