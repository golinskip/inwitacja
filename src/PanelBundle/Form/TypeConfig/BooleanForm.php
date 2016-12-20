<?php
namespace PanelBundle\Form\TypeConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\ParameterType\Boolean;

class BooleanForm extends AbstractType {
    const VALUE_EMPTY = 'empty';
    const VALUE_TRUE = 'true';
    const VALUE_FALSE = 'false';
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $layoutList = [];
        foreach(Boolean::$layoutList as $layout) {
            $layoutList['eventConfig.typeConfig.boolean.layoutList.'.$layout] = $layout;
        }
        
        $builder
            ->add('enableEmpty', CheckboxType::class, array(
                'label' => 'eventConfig.typeConfig.boolean.enableEmpty',
                'required' => false,
            ))
            ->add('default', ChoiceType::class, array(
                'label' => 'eventConfig.typeConfig.boolean.default',
                'choices'  => [
                    'eventConfig.typeConfig.boolean.defaultList.empty' => self::VALUE_EMPTY,
                    'eventConfig.typeConfig.boolean.defaultList.trueVal' => self::VALUE_TRUE,
                    'eventConfig.typeConfig.boolean.defaultList.falseVal' => self::VALUE_FALSE,
                ],
            ))
            ->add('truePrice', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.boolean.truePrice',
                'required' => false,
            ))
            ->add('falsePrice', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.boolean.falsePrice',
                'required' => false,
            ))
            ->add('layout', ChoiceType::class, array(
                'label' => 'eventConfig.typeConfig.boolean.layout',
                'choices' => $layoutList,
            ))
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Boolean::class,
        ]);
    }
}