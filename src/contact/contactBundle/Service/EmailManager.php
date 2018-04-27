<?php

namespace contact\contactBundle\Service;


use contact\contactBundle\Entity\Contact;
use Swift_Mailer;
use Symfony\Bundle\TwigBundle\TwigEngine;

class EmailManager
{
    private $templating;
    private $mailer;
    private $ourMail;

    private $subject;
    private $body;
    private $receiver;


    public function __construct(Swift_Mailer $mailer,TwigEngine $templating, $ourMail)
    {

        $this->templating = $templating;
        $this->ourMail = $ourMail;
        $this->mailer = $mailer;

    }

    protected function setTemplate($template, array $option)
    {
        return $this->templating->render($template, $option);

    }


    /**
     * our mail to receive message of contact
     * from parameter
     * @param $ourMail
     *
     * objet contact hydrate par le formulaire
     * @param $contact
     */
    public function emailContact(Contact $contact)
    {

        $this->subject = 'contact Mail';
        $this->receiver = $this->ourMail;
        $this->body = $this->setTemplate('@contact/Message/contactMessage.html.twig', array('contact' => $contact));
        $this->sendTo();

    }


    protected function sendTo()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom($this->ourMail)
            ->setTo($this->receiver)
            ->setCharset('utf-8')
            ->setContentType('text/html')
            ->setBody($this->body);
        $this->mailer->send($message);


    }

}
