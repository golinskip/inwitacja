<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use PanelBundle\Form\EventConfig\InvitationGroupForm;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\Event;

class EventConfigForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
           ->add('invitationGroup', CollectionType::class, [
                'label' => false,
                'entry_type'    => InvitationGroupForm::class,
                'entry_options'  => array(
                    'label' => false
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'required'     => false,
           ])
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}