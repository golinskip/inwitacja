<?php
namespace PanelBundle\Form\TypeConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\ParameterType\EnumRecord;

class EnumRecordForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'eventConfig.typeConfig.enum.name',
                'attr' => [
                    'placeholder' => 'eventConfig.typeConfig.enum.enumRecords.name',
                ],
            ))
            ->add('priceModifier', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.enum.enumRecords.priceModifier',
                'required' => false,
            ))
            ->add('limit', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.enum.enumRecords.limit',
                'required' => false,
            ))
            ->add('default', CheckboxType::class, array(
                'label' => 'eventConfig.typeConfig.enum.enumRecords.default',
                'required' => false,
            ))
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => EnumRecord::class,
        ]);
    }
}