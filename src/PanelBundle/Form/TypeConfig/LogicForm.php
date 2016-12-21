<?php
namespace PanelBundle\Form\TypeConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\ParameterType\Logic;

class LogicForm extends AbstractType {
    const VALUE_EMPTY = 'empty';
    const VALUE_TRUE = 'true';
    const VALUE_FALSE = 'false';
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $layoutList = [];
        foreach(Logic::$layoutList as $layout) {
            $layoutList['eventConfig.typeConfig.logic.layoutList.'.$layout] = $layout;
        }
        
        $builder
            ->add('enableEmpty', CheckboxType::class, array(
                'label' => 'eventConfig.typeConfig.logic.enableEmpty',
                'required' => false,
            ))
            ->add('default', ChoiceType::class, array(
                'label' => 'eventConfig.typeConfig.logic.default',
                'choices'  => [
                    'eventConfig.typeConfig.logic.defaultList.empty' => self::VALUE_EMPTY,
                    'eventConfig.typeConfig.logic.defaultList.trueVal' => self::VALUE_TRUE,
                    'eventConfig.typeConfig.logic.defaultList.falseVal' => self::VALUE_FALSE,
                ],
            ))
            ->add('truePrice', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.logic.truePrice',
                'required' => false,
            ))
            ->add('falsePrice', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.logic.falsePrice',
                'required' => false,
            ))
            ->add('layout', ChoiceType::class, array(
                'label' => 'eventConfig.typeConfig.logic.layout',
                'choices' => $layoutList,
            ))
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Logic::class,
        ]);
    }
}