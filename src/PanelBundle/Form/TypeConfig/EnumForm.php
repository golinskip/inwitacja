<?php
namespace PanelBundle\Form\TypeConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\ParameterType\Enum;

class LogicForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('enableEmpty', CheckboxType::class, array(
                'label' => 'eventConfig.typeConfig.enum.enableEmpty',
                'required' => false,
            ))
            ->add('truePrice', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.enum.truePrice',
                'required' => false,
            ))
            ->add('falsePrice', NumberType::class, array(
                'label' => 'eventConfig.typeConfig.enum.falsePrice',
                'required' => false,
            ))
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Enum::class,
        ]);
    }
}