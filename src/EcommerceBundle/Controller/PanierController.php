<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\CmdProd;
use EcommerceBundle\Entity\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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


    /**
     * call to methode in our service panierManager
     *
     * @return JsonResponse
     */
    public function deleteAction()
    {
        return $this->get('ecommerce.panier.manager')->deleteProduct();
    }

    /**
     * show panier client
     *
     * @return Response
     * @throws \Exception
     */
    public function showAction()
    {

        $panierManager = $this->get('ecommerce.panier.manager');
        $panier = $panierManager->getPanierSession();
        $listProduct = $panierManager->retrieveProductPanier();

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
        $em->flush();

        $listProduct = $rep->getProductPanier(array_keys($panierProduct));
        $tel = $request->request->get('numTel');
        $this->get('contact.email.manager')->validationMail($listProduct, $tel, $panierProduct);

        $session->getFlashBag()->add('validation', 'vous recevrez un appel pour confirmez votre commande');

        $session->remove('panier');

        return $this->redirectToRoute('product_index');

    }

}
