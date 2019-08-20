<?php


namespace Sem\Classes;

use Sem\Interfaces\Chargeable;
use Sem\Interfaces\IdentityObject;
use Sem\Traits\IdentityTrait;
use Sem\Traits\PriceUtility;

class ShopProduct implements Chargeable, IdentityObject
{
    use PriceUtility, IdentityTrait;

    const AVAILABLE = 0;
    const OUT_OF_STOCK = 1;
    private $id = 0;
    private $title;
    private $productMainName;
    private $productFirstName;
    protected $price;
    private $discount =  0;

    public function __construct( string $title, string $firstName, string $mainName, float $price, int $numPages = 0, int $playLength = 0)
    {
        $this->title = $title;
        $this->productFirstName = $firstName;
        $this->productMainName  = $mainName;
        $this->price = $price;
    }

    public function getProducer()
    {
        return $this->productFirstName . " " .$this->productMainName;
    }

    public function getSummaryLine()
    {
        $base = "{$this->title} ( {$this->productMainName}, ";
        $base .= "{$this->productFirstName} )";
        return $base;
    }

    /**
     * @param int $discount
     */
    public function setDiscount(int $discount)
    {
        $this->discount = $discount;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getProductFirstName()
    {
        return $this->productFirstName;
    }

    /**
     * @return string
     */
    public function getProductMainName()
    {
        return $this->productMainName;
    }

    /**
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public static function getInstance(int $id, \PDO $pdo)
    {
        $stmt = $pdo->prepare("select * from products where id=?");
        $result = $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (empty($row)){
            return null;
        }
        if ($row['type'] == "book"){
            $product = new BookProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                (float) $row['price'],
                (int) $row['numpages']
            );
        } elseif ($row['type'] == "cd"){
            $product = new CdProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                (float) $row['price'],
                (int) $row['playlenght']
            );
        } else {
            $firstname = (is_null($row['firstname'])) ? "" : $row['firstname'];
            $product = new ShopProduct(
                $row['title'],
                $firstname,
                $row['mainname'],
                (float) $row['price']
            );
        }
        $product->setId((int) $row['id']);
        $product->setDiscount((int) $row['discount']);
        return $product;
    }
}