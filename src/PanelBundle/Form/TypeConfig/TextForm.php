<?php
namespace PanelBundle\Form\TypeConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\ParameterType\Text;

class TextForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $inputTypes = [];
        foreach(Text::$inputTypeList as $inputType) {
            $inputTypes['eventConfig.typeConfig.text.inputTypes.'.$inputType] = $inputType;
        }
    
        $builder
            ->add('nullable', CheckboxType::class, [
                'label' => 'eventConfig.typeConfig.text.nullable',
                'required' => false,
            ])
            ->add('inputType', ChoiceType::class, [
                'label' => 'eventConfig.typeConfig.text.inputType',
                'choices' => $inputTypes,
            ])
            ->add('maxLength', NumberType::class, [
                'label' => 'eventConfig.typeConfig.text.maxLength',
                'required' => false,
            ])
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Text::class,
        ]);
    }
}