<?php


namespace Sem\Classes;


use Sem\Traits\PriceUtility;
use Sem\Traits\TaxTools;

class UtilityService extends Service
{
    use PriceUtility, TaxTools {
        TaxTools::calculateTax insteadof PriceUtility;
        PriceUtility::calculateTax as basicTax;
    }
}
