<?php
namespace PanelBundle\Form\Generators;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class VignetteForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('flexure', CheckboxType::class, array(
                'label' => 'generator.vignette.flexure',
                'required' => false,
            ))
            ;
    }
}