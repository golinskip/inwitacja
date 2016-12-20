<?php
namespace PanelBundle\Form\TypeConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\InvitationGroup;

class BooleanForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        // Mo¿liwa wartoœæ niezdefiniowana
        // Domyœlna wartoœæ
        // Modyfikator ceny, gdy prawdziwe
        // Modyfikator ceny, gdy fa³szywe
        // Sposób wyboru: przycisk, checkbox, combobox
            ->add('undefined', CheckboxType::class, array(
                'label' => 'eventConfig.typeConfig.boolean.undefined',
                'required' => false,
            ))
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }
}