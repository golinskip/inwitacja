<?php
namespace PanelBundle\Form\TypeConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\ParameterType\Number;

class NumberForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        
        $builder
            ->add('maxNum', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.number.maxNum',
                'required' => false,
            ))
            ->add('minNum', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.number.minNum',
                'required' => false,
            ))
            ->add('decimals', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.number.decimals',
                'required' => false,
            ))
            ->add('priceFactor', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.number.priceFactor',
                'required' => false,
            ))
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Number::class,
        ]);
    }
}