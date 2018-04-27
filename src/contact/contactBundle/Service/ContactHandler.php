<?php

namespace contact\contactBundle\Service;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

class ContactHandler
{
    private $form;
    private $request;
    private $session;
    private $mail;

    public function __construct(Form $form, RequestStack $request, Session $session, EmailManager $mail)
    {
        $this->form = $form;
        $this->request = $request;
        $this->session = $session;
        $this->mail = $mail;

    }

    public function getForm()
    {
        return $this->form;
    }


    public function process()
    {
        $this->form->handleRequest($this->request->getMasterRequest());
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->onSuccess();

            return true;
        } else {
            return false;
        }
    }


    protected function onSuccess()
    {

        $this->mail->emailContact($this->form->getData());
        $this->session->getFlashBag()->add('info', 'votre msg a ete envoye avec success');
        //session
        //envoi msg
    }

}
