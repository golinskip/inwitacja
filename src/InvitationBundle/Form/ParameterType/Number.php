<?php
namespace InvitationBundle\Form\ParameterType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class Number implements ParameterTypeInterface {
    public function addField($form, $name, $TypeConfig) {
        $form->add('value', TextType::class, [
            'label' => $name,
        ]);
    }
}