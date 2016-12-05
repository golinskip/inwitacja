<?php
namespace PanelBundle\Form\EventConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use InvitationBundle\Entity\PersonGroup;

class PersonGroupForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'invitationEditor.form.name',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.name',
                ],
            ])
            
           ->add('person', CollectionType::class, [
                'label' => 'invitationEditor.form.persons',
                'entry_type'    => PersonInInvitationForm::class,
                'entry_options'  => array(
                    'label' => false
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'required'     => false,
           ])
            ->add('phone', TextType::class, [
                'label' => 'invitationEditor.form.phone',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.phone',
                ],
                'required' => false,
            ])
            ->add('email', TextType::class, [
                'label' => 'invitationEditor.form.email',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.email',
                ],
                'required' => false,
            ])
            ;
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => PersonGroup::class,
        );
    }
}