<?php
namespace InvitationBundle\Form\ParameterType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use InvitationBundle\Entity\ParameterType\Enum as EnumEntity;

class Enum implements ParameterTypeInterface {
    public function addField($form, $name, $TypeConfig) {
        $choices = [];
        foreach($TypeConfig->getEnumRecord() as $EnumRecord) {
            $choices[$EnumRecord->getName()] = $EnumRecord->getName();
        }
        
        $expanded = ($TypeConfig->getLayout() == EnumEntity::LAYOUT_DROPDOWN)?false:true;
        $multiple = $TypeConfig->getMultichoice();
        
        $form->add('value', ChoiceType::class, [
            'label' => $name,
            'choices' => $choices,
            'multiple' => $multiple,
            'expanded' => $expanded,
        ]);
    }
}