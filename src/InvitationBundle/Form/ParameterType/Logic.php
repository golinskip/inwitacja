<?php
namespace InvitationBundle\Form\ParameterType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class Logic implements ParameterTypeInterface {
    public function addField($form, $name, $TypeConfig) {
        dump($TypeConfig);
        $form->add('value', TextType::class, [
            'label' => $name,
        ]);
    }
}