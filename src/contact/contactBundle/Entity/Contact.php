<?php

namespace contact\contactBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $client;


    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 30, minMessage="The content is very short")
     */
    private $reclamation;


    /**
     * Set client
     *
     * @param string $client
     *
     * @return Contact
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set reclamation
     *
     * @param string $reclamation
     *
     * @return Contact
     */
    public function setReclamation($reclamation)
    {
        $this->reclamation = $reclamation;

        return $this;
    }

    /**
     * Get reclamation
     *
     * @return string
     */
    public function getReclamation()
    {
        return $this->reclamation;
    }
}
