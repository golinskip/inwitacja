<?php

namespace InvitationBundle\Form\ParameterType;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use InvitationBundle\Entity\ParameterType\Logic as LogicEntity;

class Logic implements ParameterTypeInterface {

    public function addField($form, $name, $TypeConfig) {
        switch ($TypeConfig->getLayout()) {
            case LogicEntity::LAYOUT_BUTTON:
                $this->buildChoice($form, $name, $TypeConfig, true);
                break;
            case LogicEntity::LAYOUT_RADIOBUTTON:
                $this->buildChoice($form, $name, $TypeConfig, true);
                break;
            case LogicEntity::LAYOUT_DROPDOWN:
                $this->buildChoice($form, $name, $TypeConfig, false);
                break;
        }
    }

    private function buildChoice($form, $name, $TypeConfig, $expanded) {
        $form->add('value', ChoiceType::class, [
            'label' => $name,
            'choices' => [
                'eventConfig.typeConfig.logic.defaultList.trueVal' => LogicEntity::VALUE_TRUE,
                'eventConfig.typeConfig.logic.defaultList.falseVal' => LogicEntity::VALUE_FALSE,
            ],
            'multiple' => false,
            'expanded' => $expanded,
        ]);
    }

}
