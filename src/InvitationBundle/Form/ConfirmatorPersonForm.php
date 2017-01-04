<?php
namespace InvitationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\Person;

class ConfirmatorPersonForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'confirmator.form.person.name',
                'attr' => [
                    'placeholder' => 'confirmator.form.person.name',
                ],
            ])
            ->add('status', ChoiceType::class, array(
                'label' => 'confirmator.form.person.statuses',
                'choices'  => [
                    'confirmator.form.person.status.present' => Person::STATUS_PRESENT,
                    'confirmator.form.person.status.absent' => Person::STATUS_ABSENT,
                    'confirmator.form.person.status.undefined' => Person::STATUS_UNDEFINED,
                ],
            ))
           ->add('parameterValue', CollectionType::class, [
                'label' => false,
                'entry_type'    => ConfirmatorParameterForm::class,
                'entry_options'  => array(
                    'label' => false,
                ),
                'required'     => false,
                'prototype'    => false,
           ])
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Person::class,
        ));
    }
}