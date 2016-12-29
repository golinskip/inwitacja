<?php
namespace InvitationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\Invitation;
use InvitationBundle\Entity\Person;

class ConfirmatorForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
           ->add('person', CollectionType::class, [
                'label' => 'confirmator.form.persons',
                'entry_type'    => ConfirmatorPersonForm::class,
                'entry_options'  => [
                    'label' => false,
                ],
                'prototype'    => false,
                'allow_add' => false,
                'allow_delete' => false,
                'required'     => false,
           ])
            ->add('submit', SubmitType::class, [
                'label' => 'confirmator.form.submit'
            ])
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Invitation::class,
        ]);
    }
}