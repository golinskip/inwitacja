<?php
namespace PanelBundle\Form\Generators;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ExcelListForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('onlyConfirmed', CheckboxType::class, array(
                'label' => 'generator.excelList.onlyConfirmed',
                'required' => false,
            ))
            ->add('addCode', CheckboxType::class, array(
                'label' => 'generator.excelList.addCode',
                'required' => false,
            ))
            ;
    }
}