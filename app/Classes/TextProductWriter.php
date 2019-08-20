<?php


namespace Sem\Classes;


class TextProductWriter extends ShopProductWriter
{
    public function write()
    {
        $str = "Товары: \n";
        foreach ($this->products as $shopProduct){
            $str .= $shopProduct->getSummaryLine() . "\n";
        }
        echo $str;
    }
}