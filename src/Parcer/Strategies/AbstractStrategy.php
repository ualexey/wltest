<?php

namespace App\Parcer\Strategies;

use App\Parcer\Interfaces\ParcerStrategyInterface;

class AbstractStrategy implements ParcerStrategyInterface
{
    /**
     * @return array
     */
    public function run(): array
    {
        return [];
    }
}