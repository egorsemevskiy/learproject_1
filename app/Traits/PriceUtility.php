<?php

namespace Sem\Traits;

trait PriceUtility
{
    private $taxrate = 17;

    function calculateTax(float $price): float
    {
        return (($this->taxrate/100) * $price);
    }

}
