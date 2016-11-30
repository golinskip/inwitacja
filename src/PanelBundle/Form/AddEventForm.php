<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AddEventForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $locale = $options['attr']['locale'];
        $builder
            ->add('name', TextType::class, array('label' => 'eventManager.addDialog.name'))
            ->add('eventType', EntityType::class, array('label' => 'eventManager.addDialog.type', 'class' => 'InvitationBundle:EventType', 'choice_label' => 
                function ($value, $key, $index) use ($locale){
                    return $value->getNameTranslation()->getValue($locale);
                }))
            ->add('description', TextType::class, array('label' => 'eventManager.addDialog.description', 'required' => false))
            ->add('date', DateType::class, array('label' => 'eventManager.addDialog.date'))
            ->add('place', TextType::class, array('label' => 'eventManager.addDialog.place', 'required' => false))
            ;
    }
}