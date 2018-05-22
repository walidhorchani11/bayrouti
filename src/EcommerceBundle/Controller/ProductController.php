<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('EcommerceBundle:Product')->findAll();

        return $this->render('EcommerceBundle:Product:index.html.twig', array('products' => $products));
    }

    public function product_homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('EcommerceBundle:Product')->findBy(array(),array("id"=>"DESC"),4,0);

        return $this->render('EcommerceBundle:Product:product_home.html.twig', array('products' => $products));
    }


}
