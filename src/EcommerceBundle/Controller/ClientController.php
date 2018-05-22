<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 */
class ClientController extends Controller
{
    /**
     * Lists all client entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('EcommerceBundle:Client')->findAll();

        return $this->render('EcommerceBundle:Client:index.html.twig', array(
            'clients' => $clients,
        ));
    }

    public function client_homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('EcommerceBundle:Client')->findBy(array(),array('id'=>'DESC'),4,0);

        return $this->render('EcommerceBundle:Client:client_home.html.twig', array('clients' => $clients));
    }

}
