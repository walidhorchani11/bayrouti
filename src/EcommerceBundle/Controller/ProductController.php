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

        /*$data = $this->get('jms_serializer')->serialize($products,'json');

        $response = new Response($data,'200');
        $response->headers->set('content-type','application/json');
        return $response;*/

        return $this->render('EcommerceBundle:Product:index.html.twig', array('products' => $products));
    }

    public function showAction($id)
    {

        $product = $this->getDoctrine()->getManager()->getRepository('EcommerceBundle:Product')->getProductComment($id);

        // serialisatioin d'objet en json (linearisatioon)
        $data = $this->get('jms_serializer')->serialize($product, 'json');
        return new Response($data,'200', array('content-type' => 'application/json'));


        //return $this->render('EcommerceBundle:Product:show.html.twig', array('product' => $product));
    }



    public function createproductAction(Request $request)
    {

        $data = $request->getContent();
        $product = $this->get('jms_serializer')->deserialize($data,'EcommerceBundle\Entity\Product','json');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($product);
        $em->flush();

        return new Response('','200');

    }

}
