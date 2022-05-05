<?php

namespace App\Parcer\Interfaces;

interface  ParcerStrategyInterface
{
    /**
     * @return array
     */
    public function run(): array;

}
