<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use PanelBundle\Form\EventConfig\InvitationGroupForm;
use PanelBundle\Form\EventConfig\PersonGroupForm;
use PanelBundle\Form\EventConfig\ParameterForm;
use InvitationBundle\Entity\Event;

class EventConfigForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
           ->add('invitationGroup', CollectionType::class, [
                'label' => false,
                'entry_type'    => InvitationGroupForm::class,
                'entry_options'  => array(
                    'label' => false
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'required'     => false,
           ])
            ;
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => Event::class,
        );
    }
}