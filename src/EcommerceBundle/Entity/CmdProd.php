<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CmdProd
 *
 * @ORM\Table(name="cmd_prod")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Repository\CmdProdRepository")
 */
class CmdProd
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="EcommerceBundle\Entity\Command", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="EcommerceBundle\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;


    /**
     * @var int
     *
     * @ORM\Column(name="qte", type="integer")
     */
    private $qte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());

    }


    /**
     * Set qte
     *
     * @param integer $qte
     * @return CmdProd
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return integer
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return CmdProd
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set commande
     *
     * @param \EcommerceBundle\Entity\Command $commande
     * @return CmdProd
     */
    public function setCommande(\EcommerceBundle\Entity\Command $commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \EcommerceBundle\Entity\Command
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set product
     *
     * @param \EcommerceBundle\Entity\Product $product
     * @return CmdProd
     */
    public function setProduct(\EcommerceBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \EcommerceBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
