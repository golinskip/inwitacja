<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\Person;

class PersonInInvitationForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'invitationEditor.form.person.name',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.person.name',
                ],
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'invitationEditor.form.person.status',
                'choices'  => [
                    'invitationEditor.form.person.statusType.undefined' => Person::STATUS_UNDEFINED,
                    'invitationEditor.form.person.statusType.enable' => Person::STATUS_ENABLE,
                    'invitationEditor.form.person.statusType.disable' => Person::STATUS_DISABLE,
                ],
            ])
            ;
    }
    
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Person::class,
        ));
    }
}