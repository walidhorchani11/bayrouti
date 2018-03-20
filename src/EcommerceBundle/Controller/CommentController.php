<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Comment;
use EcommerceBundle\Entity\Product;
use EcommerceBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function newAction(Product $product, Request $request)
    {

        $comment = new Comment();
        $form = $this->createForm('EcommerceBundle\Form\CommentType', $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $comment->setProduct($product);
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('comment_show');
        }


        return $this->render('EcommerceBundle:Comment:new.html.twig', array('form' => $form->createView()));
    }

    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('EcommerceBundle:Comment')->findAll();

        return $this->render('EcommerceBundle:Comment:show.html.twig', array('comments' => $comments));


    }

}
