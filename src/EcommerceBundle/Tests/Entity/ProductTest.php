<?php

namespace EcommerceBundle\Tests\Controller;

use EcommerceBundle\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    /**
     * @dataProvider pricesforfood
     */
    public function test_compte_tva_food($price, $expectedTVA)
    {
        $product = new Product();
        $product->setName('food');
        $product->setPrice($price);
        $this->assertSame($expectedTVA, $product->compteTVA());
    }

    public function test_compte_tva_autre()
    {
        $product = new Product();
        $product->setName('autre');
        $product->setPrice(800);
        $this->assertSame(400.0, $product->compteTVA());
    }

    public function testnegativePrice()
    {
        $product = new Product();
        $product->setPrice(-558);
        $product->setName('food');
        $this->expectException('LogicException');
        $product->compteTVA();
    }

    public function pricesforfood()
    {
        return [
            [2000, 2.0],
            [8000, 8.0],
            [10000, 10.0]


        ];
    }

}
