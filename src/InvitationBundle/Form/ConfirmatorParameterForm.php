<?php
namespace InvitationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                $ParameterTypeField->addField($form, $Parameter->getName(), $Parameter->getTypeConfigObj());
            })
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => ParameterValue::class,
        ]);
    }
}