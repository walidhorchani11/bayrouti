<?php

namespace EcommerceBundle\Service;


use Doctrine\ORM\EntityManager;
use EcommerceBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Session\Session;

class CalculSomme
{

    //la session contient tout le necessaire l id du produit
    //et par consequent le prix, ainsi la qte ....
    // array panier --> $panier[id_product] : qte
    private $session;
    private $em;

    public function __construct(Session $session, EntityManager $entityManager)
    {
        $this->session = $session;
        $this->em = $entityManager;
    }

    public function coutProduct(Product $product)
    {
        $price = $product->getPrice();

        // recuperer la quantite pour ca on abesoin de recuperer la session panier
        $panier = $this->session->get('panier');
        $qte = $panier[$product->getId()];
        $cout = $qte * $price;

        return $cout;

    }

    public function coutPanier()
    {

        $total = 0;
        //recuperer les produits du panier
        $panier = $this->session->get('panier');
        $listProduct = $this->em->getRepository('EcommerceBundle:Product')->getProductPanier(array_keys($panier));

        foreach ($listProduct as $product) {
            $total += $this->coutProduct($product);
        }

        return $total;
    }


}


