<?php

namespace Page\PageBundle\Controller;

use Page\PageBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{

    /**
     * Finds and displays a page entity named about as title
     *
     */
    public function aboutAction()
    {

        $page = $this->getDoctrine()->getRepository('PageBundle:Page')->findOneBy(array('title'=>'about'));

        return $this->render('@Page/Page/about.html.twig', array(
            'page' => $page
        ));
    }

    /**
     * Finds and displays a page entity named offre as title
     *
     */
    public function offreAction()
    {

        $page = $this->getDoctrine()->getRepository('PageBundle:Page')->findOneBy(array('title'=>'offre'));

        return $this->render('@Page/Page/offre.html.twig', array(
            'page' => $page
        ));
    }



}
