<?php
namespace PanelBundle\Form\EventConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use InvitationBundle\Entity\InvitationGroup;

class InvitationGroupForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'eventConfig.form.invitationGroup.name',
                'attr' => [
                    'placeholder' => 'eventConfig.form.invitationGroup.name',
                ],
            ])
            ->add('color', TextType::class, [
                'label' => 'eventConfig.form.invitationGroup.color',
                'attr' => [
                    'placeholder' => 'eventConfig.form.invitationGroup.color',
                ],
            ])
            ;
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => InvitationGroup::class,
        );
    }
}