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

    /**
     * call method in our service to add or remove product from panier session
     *
     * @return JsonResponse
     */
    public function add_removeAction()
    {
        return $this->get('ecommerce.panier.manager')->addOrRmoveProduct();

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

    /**
     * call method of our service to update qte
     * for product already exist in session panier & update it
     *
     * @return JsonResponse
     */
    public function updateAction()
    {

        return $this->get('ecommerce.panier.manager')->updateProduct();

    }


    /**
     * call this method when client validate his command
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function validerAction()
    {

        $this->get('ecommerce.panier.manager')->validerCommande();

        return $this->redirectToRoute('product_index');

    }

}
