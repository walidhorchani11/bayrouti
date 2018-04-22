<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\CmdProd;
use EcommerceBundle\Entity\Command;
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

    public function showAction()
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


    public function validerAction(Request $request)
    {

        //recuperre la session panier
        $session = $this->get('session');
        $panierProduct = $session->get('panier');
        $cmd = new Command();

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('EcommerceBundle:Product');
        $em->persist($cmd);

        foreach ($panierProduct as $key => $singleProduct) {
            $cmdProd = new CmdProd();
            $cmdProd->setCommande($cmd);

            $product = $rep->find($key);
            $cmdProd->setProduct($product);

            $cmdProd->setQte($singleProduct);
            $em->persist($cmdProd);

        }
//TODO :ajout d flash bag msg
        $em->flush();
        $session->remove('panier');


        return $this->redirectToRoute('product_index');


        //num tel pour lajouter a msg envoye a admin pour conatcter le client
        // $tel  = $request->request->get('tel');

        /*  $message =  \Swift_Message::newInstance()
              ->setFrom('walidhorchani11@gmail.com')
              ->setTo('walidhorchani11@gmail.com')
              ->setBody(
                  $this->renderView(
                  // app/Resources/views/Emails/registration.html.twig
                      '@Ecommerce/Comment/new.html.twig'
                  ),
                  'text/html'
              )*/
        /*
          If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )

    ;*/

        /* $this->get('mailer')->send($message);

         return $this->redirectToRoute('product_index');*/
    }

}
