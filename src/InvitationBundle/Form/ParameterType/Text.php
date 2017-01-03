<?php
namespace InvitationBundle\Form\ParameterType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use InvitationBundle\Entity\ParameterType\Text as TextEntity;

class Text implements ParameterTypeInterface {
    public function addField($form, $name, $TypeConfig) {
        $TypeClass = ($TypeConfig->getInputType() == TextEntity::INPUT_TYPE_TEXTAREA) ?  TextareaType::class : TextType::class;
        
        $form->add('value', $TypeClass, [
            'label' => $name,
        ]);
    }
}