<?php

namespace contact\contactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client', null, array('attr' => array('placeholder' => 'restaurant', 'required' => true)))
            ->add('reclamation', TextareaType::class,
                array('attr' => array('placeholder' => 'sujet / votre reclamation', 'rows' => '3', 'required' => true)))
            ->add('envoyer', SubmitType::class, array('attr' => array('class' => 'btn btn-primary')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'contact\contactBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contact_contactbundle_contact';
    }


}
