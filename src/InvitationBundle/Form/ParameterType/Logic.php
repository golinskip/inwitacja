<?php
namespace InvitationBundle\Form\ParameterType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use InvitationBundle\Entity\ParameterType\Logic as LogicEntity;

class Logic implements ParameterTypeInterface {
    public function addField($form, $name, $TypeConfig) {
        switch($TypeConfig->getLayout()) {
            case LogicEntity::LAYOUT_CHECKBOX:
                $this->buildCheckbox($form, $name, $TypeConfig);
            break;
            case LogicEntity::LAYOUT_BUTTON:
                $this->buildChoice($form, $name, $TypeConfig, true);
            break;
            case LogicEntity::LAYOUT_DROPDOWN:
                $this->buildChoice($form, $name, $TypeConfig, false);
            break;
        }
    }
    
    private function buildCheckbox($form, $name, $TypeConfig) {
        $form->add('value', CheckboxType::class, [
            'label' => $name,
        ]);
    }
    
    private function buildChoice($form, $name, $TypeConfig, $expanded) {
        $vals = [
            'eventConfig.typeConfig.logic.defaultList.trueVal' => LogicEntity::VALUE_TRUE,
            'eventConfig.typeConfig.logic.defaultList.falseVal' => LogicEntity::VALUE_FALSE,
        ];
        if($TypeConfig->getEnableEmpty() === true) {
            $vals['eventConfig.typeConfig.logic.defaultList.empty'] = LogicEntity::VALUE_EMPTY;
        }
        $form->add('value', ChoiceType::class, [
            'label' => $name,
            'choices'  => $vals,
            'multiple' => false,
            'expanded' => $expanded,
        ]);
    }
}