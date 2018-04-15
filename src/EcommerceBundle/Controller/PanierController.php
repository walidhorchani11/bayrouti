<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\CmdProd;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PanierController extends Controller
{
    public function addAction(Request $request)
    {

        $session = $this->get('session');
        //on test si on a pas session 'panier' on va le crer
        if (!$session->has('panier'))
            $session->set('panier', array());


        $panier = $session->get('panier');

        //recuperer id du produit qu on veut ajouter
        $idProd = $request->query->get('id');

        //on test si ce produit n'existe pas dans le panier on le rajout..sil existe on le supprime
        if (!array_key_exists($idProd, $panier)) {

            $qte = $request->query->get('qte');
            $panier[$idProd] = $qte;
            echo " produit ajouter avec succes";

        } else {
            unset($panier[$idProd]);
            //echo "product exixst on va le supprimer";
        }

        //mise a jour de la session
        $session->set('panier', $panier);

        var_dump($panier);
        die;

        //return;

        //$cmdProd = new CmdProd();

        /* $idProd = $request->query->get('id');
         $qte = $request->query->get('qte');
         $em = $this->getDoctrine()->getManager();
         $product = $em->getRepository('EcommerceBundle:Product')->findOneBy(array('id' => $idProd));*/

        /* $cmdProd->setProduct($product);
         $cm
        dProd->setQte($qte);*/

        //on ajout au session panier cette commnade du produit et sa qte mais la creation
        //du commande pour laffecter a cmdProd ne se fait qu au stade du persist ca validation
        //du panier


        //array_push($panier, $cmdProd);

        /* $data = $this->get('jms_serializer')->serialize($product,'json');

         $response = new Response($data);
         $response->headers->set('content-type', 'application/json');
         return $response;*/

        /*$idProd = $request->query->get('id');
        $qte = $request->query->get('qte');
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('EcommerceBundle:Product')->findOneBy(array('id' => $idProd));
        $data = $product->getName();

        $response = new JsonResponse($qte);
        $response->headers->set('content-type', 'application/json');
        return $response;*/

    }

    public function deleteAction(Request $request)
    {

        $idProd = $request->query->get('idProd');
        $session = $this->get('session');
        $panier = $session->get('panier');
        unset($panier[$idProd]);
        $session->set('panier', $panier);

        die;

    }

    public function showAction(Request $request)
    {

        $session = $this->get('session');
        $panier = $session->get('panier');

        $em = $this->getDoctrine()->getManager();
        $listProduct = $em->getRepository('EcommerceBundle:Product')->getProductPanier(array_keys($panier));

        return $this->render('EcommerceBundle:Panier:show.html.twig', array('listProduct' => $listProduct, 'panier' => $panier));


    }

    //methode appele en ajax pour modifier la quantite du produit
    public function updateAction(Request $request)
    {
        $idProd = $request->query->get('idProd');
        $qte = $request->query->get('qte');
        $session = $this->get('session');
        $panier = $session->get('panier');
        $panier[$idProd] = $qte;
        $session->set('panier', $panier);
        die;

    }

}
