<?php
namespace PanelBundle\Form\EventConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use InvitationBundle\Entity\Parameter;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParameterForm extends AbstractType {
    
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $paramFormList = [];
        foreach(Parameter::$typeList as $param) {
            $paramFormList['eventConfig.form.parameter.types.'.$param] = $param;
        }
        
        $builder
            ->add('name', TextType::class, [
                'label' => 'eventConfig.form.parameter.name',
                'attr' => [
                    'placeholder' => 'eventConfig.form.parameter.name',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'eventConfig.form.parameter.description',
                'attr' => [
                    'placeholder' => 'eventConfig.form.parameter.description',
                ],
                'required' => false,
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'eventConfig.form.parameter.type',
                'choices'  => $paramFormList,
            ])
            ->add('innerOrder', HiddenType::class)
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Parameter::class,
        ]);
    }
}