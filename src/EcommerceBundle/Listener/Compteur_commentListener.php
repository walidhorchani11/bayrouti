<?php

namespace EcommerceBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use EcommerceBundle\Entity\Comment;

class Compteur_commentListener
{


    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Comment) {
            return;
        }


        $product = $entity->getProduct();
        $comments = $product->getComments();
        $nbrComment = 0;
        foreach ($comments as $comment) {
            $nbrComment = $nbrComment + 1;
        }
        $product->setNbrComment($nbrComment);
        $args->getEntityManager()->flush($product);

    }


}



