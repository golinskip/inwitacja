<?php
namespace InvitationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\Invitation;

class ConfirmatorForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
           ->add('person', CollectionType::class, [
                'label' => 'confirmator.form.persons',
                'entry_type'    => ConfirmatorPersonForm::class,
                'entry_options'  => array(
                    'label' => false,
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
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