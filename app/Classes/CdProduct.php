<?php


namespace Sem\Classes;


class CdProduct extends ShopProduct
{

    private $playLength;

    public function __construct(string $title, string $firstName, string $mainName, float $price, float $playLength = 0)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLength = $playLength;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": Time playing - {$this->playLength}<br/>";
        return $base;
    }
}
