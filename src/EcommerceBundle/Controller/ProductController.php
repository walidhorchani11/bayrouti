<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('EcommerceBundle:Product')->findAll();

        /*$session = $this->get('session');
        $sessionPanier = $session->get('panier');*/

        /*$data = $this->get('jms_serializer')->serialize($products,'json');

        $response = new Response($data,'200');
        $response->headers->set('content-type','application/json');
        return $response;*/

        return $this->render('EcommerceBundle:Product:index.html.twig', array('products' => $products));
    }

    public function createproductAction(Request $request)
    {

        $data = $request->getContent();
        $product = $this->get('jms_serializer')->deserialize($data, 'EcommerceBundle\Entity\Product', 'json');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($product);
        $em->flush();

        return new Response('', '200');

    }

}
