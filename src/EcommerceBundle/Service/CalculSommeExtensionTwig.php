<?php

namespace EcommerceBundle\Service;

use EcommerceBundle\Entity\Product;

class CalculSommeExtensionTwig extends \Twig_Extension
{

    private $calculSomme;

    public function __construct(CalculSomme $calculSomme)
    {
        $this->calculSomme = $calculSomme;

    }

    public function coutProduct_extension(Product $product)
    {
        return $this->calculSomme->coutProduct($product);
    }

    public  function coutPanier_extension(){

        return $this->calculSomme->coutPanier();

    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('calculCout', array($this, 'coutProduct_extension')),
            new \Twig_SimpleFunction('calculCoutPanier', array($this, 'coutPanier_extension'))

        );
    }

}
