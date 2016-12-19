<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use PanelBundle\Form\EventConfig\InvitationGroupForm;
use PanelBundle\Form\EventConfig\PersonGroupForm;
use PanelBundle\Form\EventConfig\ParameterForm;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\Event;

class EventConfigForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $locale = $options['attr']['locale'];
        $builder
           ->add('invitationGroup', CollectionType::class, [
                'label' => false,
                'entry_type'    => InvitationGroupForm::class,
                'entry_options'  => array(
                    'label' => false,
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
           ])
           ->add('personGroup', CollectionType::class, [
                'label' => false,
                'entry_type'    => PersonGroupForm::class,
                'entry_options'  => array(
                    'label' => false,
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
           ])
           ->add('parameter', CollectionType::class, [
                'label' => false,
                'entry_type'    => ParameterForm::class,
                'entry_options'  => array(
                    'label' => false,
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
           ])
            ->add('name', TextType::class, [
                'label' => 'eventManager.addDialog.name'
            ])
            ->add('eventType', EntityType::class, [
                'label' => 'eventManager.addDialog.type',
                'class' => 'InvitationBundle:EventType',
                'choice_label' => function ($value, $key, $index) use ($locale){
                    return $value->getNameTranslation()->getValue($locale);
                },
            ])
            ->add('description', TextType::class, [
                'label' => 'eventManager.addDialog.description',
                'required' => false,
            ])
            ->add('date', DateType::class, [
                'label' => 'eventManager.addDialog.date',
            ])
            ->add('place', TextType::class, [
                'label' => 'eventManager.addDialog.place',
                'required' => false,
            ])
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}