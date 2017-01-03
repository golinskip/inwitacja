<?php
namespace InvitationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use InvitationBundle\Entity\ParameterValue;

class ConfirmatorParameterForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$object = $options['data'];
        //$Parameter = $object->getParameter();
        
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $ParameterValue = $event->getData();
                $Parameter = $ParameterValue->getParameter();
                $form = $event->getForm();
                $ParameterTypeFieldClass = "InvitationBundle\\Form\\ParameterType\\".ucfirst($Parameter->getType());
                $ParameterTypeField = new $ParameterTypeFieldClass;
                $ParameterType = $Parameter->getTypeConfigObj();
                if($ParameterValue->getValue() === null ) {
                    $ParameterValue->setValue($ParameterType->getDefault());
                }
                $ParameterTypeField->addField($form, $Parameter->getName(), $ParameterType);
            })
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ParameterValue::class,
        ]);
    }
}