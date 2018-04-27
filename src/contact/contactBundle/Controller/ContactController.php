<?php

namespace contact\contactBundle\Controller;

use contact\contactBundle\Entity\Contact;
use contact\contactBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction(Request $request)
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
