<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use PanelBundle\Form\PersonInInvitationForm;
use InvitationBundle\Entity\Invitation;

class EditInvitationForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $eventId = $options['attr']['eventId'];
        $builder
            ->add('name', TextType::class, [
                'label' => 'invitationEditor.form.name',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.name',
                ],
            ])
           ->add('person', CollectionType::class, [
                'label' => 'invitationEditor.form.persons',
                'entry_type'    => PersonInInvitationForm::class,
                'entry_options'  => array(
                    'label' => false,
                    'attr' => [
                        'eventId' => $eventId,
                    ],
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'required'     => false,
           ])
            ->add('invitationGroup', EntityType::class, [
                'label' => 'invitationEditor.form.invitationGroup',
                'class' => 'InvitationBundle:InvitationGroup',
                'query_builder' => function ($repository) use ($eventId) {
                    return $repository->createQueryBuilder('ig')
                        ->where('ig.event = :eid')
                        ->setParameter('eid', $eventId)
                        ->orderBy('ig.name', 'ASC'); 
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('phone', TextType::class, [
                'label' => 'invitationEditor.form.phone',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.phone',
                ],
                'required' => false,
            ])
            ->add('email', TextType::class, [
                'label' => 'invitationEditor.form.email',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.email',
                ],
                'required' => false,
            ])
            ;
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => Invitation::class,
        );
    }
}