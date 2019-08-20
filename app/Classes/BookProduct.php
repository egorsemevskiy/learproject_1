<?php


namespace Sem\Classes;


class BookProduct extends ShopProduct
{
    private $numPages;

    public function __construct(string $title, string $firstName, string $mainName, float $price, int $numPages = 0)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }

    public function getNumPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ":  {$this->numPages} pages<br/>";
        return $base;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}