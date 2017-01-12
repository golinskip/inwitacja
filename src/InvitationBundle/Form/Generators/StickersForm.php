<?php
namespace InvitationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class StickersForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('printUrl', CheckboxType::class, array(
                'label' => 'generator.stickers.printUrl',
                'required' => false,
            ))
            ;
    }
}