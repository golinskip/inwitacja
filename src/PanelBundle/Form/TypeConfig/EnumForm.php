<?php
namespace PanelBundle\Form\TypeConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\ParameterType\Enum;

class EnumForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nullable', CheckboxType::class, array(
                'label' => 'eventConfig.typeConfig.enum.nullable',
                'required' => false,
            ))
            ->add('showDisabled', CheckboxType::class, array(
                'label' => 'eventConfig.typeConfig.enum.showDisabled',
                'required' => false,
            ))
            ->add('showLimits', CheckboxType::class, array(
                'label' => 'eventConfig.typeConfig.enum.showLimits',
                'required' => false,
            ))
           ->add('enumRecord', CollectionType::class, [
                'label' => 'eventConfig.typeConfig.enum.enumRecord',
                'entry_type'    => EnumRecordForm::class,
                'entry_options'  => array(
                    'label' => false,
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
            'data_class' => Enum::class,
        ]);
    }
}