<?php

namespace contact\contactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function contactAction()
    {
        /* $contact = new Contact();
         $form = $this->createForm(ContactType::class, $contact);*/
        $contactHandle = $this->get('contact.handler.form');
        $form = $contactHandle->getForm();

        if ($contactHandle->process()) {

            return $this->redirectToRoute('contact_homepage');


        }

        return $this->render('contactBundle:Contact:contact.html.twig', array('form' => $form->createView()));
    }
}
