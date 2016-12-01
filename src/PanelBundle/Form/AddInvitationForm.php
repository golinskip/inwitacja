<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AddInvitationForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('invitation', TextType::class, array(
                'label' => 'invitationsManager.addDialog.invitation',
                'attr' => array(
                    'placeholder' => 'invitationsManager.addDialog.invitationPlaceholder',
                ),
            ))
            ->add('person', CollectionType::class, array(
                'entry_type'   => TextType::class,
                'label' => 'invitationsManager.addDialog.person',
                'entry_options'  => array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'invitationsManager.addDialog.personPlaceholder',
                        'class' => 'input-duplicatable',
                    ),
                    'required' => false,
                ),
                'allow_add' => true,
                'allow_delete' => true,

                'prototype' => true,
            ));
    }
}