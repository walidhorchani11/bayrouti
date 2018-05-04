<?php

namespace EcommerceBundle\Manager;


use Doctrine\ORM\EntityManager;
use EcommerceBundle\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PanierManager
{

    private $session;
    private $em;
    // private $panier;
    private $request;

    public function __construct(Session $session, EntityManager $entityManager, Request $request)
    {
        $this->session = $session;
        $this->em = $entityManager;
        //$this->panier = $session->get('panier');
        $this->request = $request;
    }


    /**
     * collect products in panier session
     *
     * @return array
     */
    public function retrieveProductPanier()
    {

        $listProduct = $this->em->getRepository('EcommerceBundle:Product')->getProductPanier(array_keys($this->getPanierSession()));

        return $listProduct;
    }

    /**
     * return panier session if exist
     *
     * @return mixed
     * @throws \Exception
     */
    public function getPanierSession()
    {
        if ($this->session->has('panier'))
            return $this->session->get('panier');
        throw new \Exception('session panier does not existe... client not done yet in purchase');

    }


    /**
     * called by ajax .. get the id of product to delete
     * then delete it from panier session and set session
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteProduct()
    {

        if ($this->request->isXmlHttpRequest()) {
            $idProd = $this->request->query->get('idProd');

            $panier = $this->getPanierSession();
            unset($panier[$idProd]);
            $this->session->set('panier', $panier);

            $response = new JsonResponse($panier);
            $response->headers->set('content-type','application/json');
            return $response;

        } else
            throw new NotFoundHttpException();
    }

}
