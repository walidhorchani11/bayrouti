<?php

namespace EcommerceBundle\Manager;


use contact\contactBundle\Service\EmailManager;
use Doctrine\ORM\EntityManager;
use EcommerceBundle\Entity\CmdProd;
use EcommerceBundle\Entity\Command;
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
    private $request;
    private $myMail;

    public function __construct(Session $session, EntityManager $entityManager, Request $request, EmailManager $myMail)
    {
        $this->session = $session;
        $this->em = $entityManager;
        //$this->panier = $session->get('panier');
        $this->request = $request;
        $this->myMail = $myMail;

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
            return $response;

        } else
            throw new NotFoundHttpException();
    }


    /**
     * get the id and qte from request ajax then update the panier session
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function updateProduct()
    {
        if ($this->request->isXmlHttpRequest()) {

            $panier = $this->getPanierSession();
            $idProd = $this->request->query->get('idProd');
            $qte = $this->request->query->get('qte');
            $panier[$idProd] = $qte;
            $this->session->set('panier', $panier);

            $response = new JsonResponse($panier);

            return $response;

        } else
            throw new NotFoundHttpException('U cant acheive this url hhhhh!!!!');

    }


    /**
     * if we have not panier session we create it
     * then we test if session panier contain the id of product
     * sent by ajax if exist we delete the product
     * else we add this product finally update session panier
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function addOrRmoveProduct()
    {
        if ($this->request->isXmlHttpRequest()) {

            //on test si on a pas session 'panier' on va le crer
            if (!$this->session->has('panier'))
                $this->session->set('panier', array());

            $panier = $this->getPanierSession();

            //recuperer id du produit qu on veut ajouter
            $idProd = $this->request->query->get('id');

            //on test si ce produit n'existe pas dans le panier on le rajout..sil existe on le supprime
            if (!array_key_exists($idProd, $panier)) {
                $panier[$idProd] = '1';
            } else {
                unset($panier[$idProd]);
            }

            //mise a jour de la session
            $this->session->set('panier', $panier);

            $response = new JsonResponse($panier);
            return $response;

        } else
            throw new NotFoundHttpException('U cant acheive this url hhhhh!!!!');

    }


    /**
     * validation of command with send of mail
     *
     * @throws \Exception
     */
    public function validerCommande()
    {

        //recuperer la session panier
        $panierProduct = $this->getPanierSession();
        $cmd = new Command();
        $this->em->persist($cmd);

        foreach ($panierProduct as $key => $qte) {
            $cmdProd = new CmdProd();

            $cmdProd->setCommande($cmd);

            //get product to inject it into CmdProd
            $product = $this->em->getRepository('EcommerceBundle:Product')->find($key);
            $cmdProd->setProduct($product);

            //put qte in CmdProd
            $cmdProd->setQte($qte);

            $this->em->persist($cmdProd);

        }
        $this->em->flush();

        //preparer le terrain pour envoi du mail
        $listProduct = $this->em->getRepository('EcommerceBundle:Product')->getProductPanier(array_keys($panierProduct));
        $tel = $this->request->request->get('numTel');

        $this->myMail->validationMail($listProduct, $tel, $panierProduct);

        $this->session->getFlashBag()->add('validation', 'vous recevrez un appel pour confirmez votre commande');

        $this->session->remove('panier');

    }

}
