<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use PanelBundle\Form\PersonInInvitationForm;
use InvitationBundle\Entity\Invitation;

class EditInvitationForm extends AbstractType {
    
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
            ])
            ->add('email', TextType::class, [
                'label' => 'invitationEditor.form.email',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.email',
                ],
            ])
            ;
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => Invitation::class,
        );
    }
}