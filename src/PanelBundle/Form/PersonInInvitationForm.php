<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\Person;

class PersonInInvitationForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $eventId = $options['attr']['eventId'];
        $builder
            ->add('name', TextType::class, [
                'label' => 'invitationEditor.form.person.name',
                'attr' => [
                    'placeholder' => 'invitationEditor.form.person.name',
                ],
            ])
            ->add('innerOrder', HiddenType::class)
            ->add('personGroup', EntityType::class, [
                'label' => 'invitationEditor.form.person.personGroup',
                'class' => 'InvitationBundle:PersonGroup',
                'query_builder' => function ($repository) use ($eventId) {
                    return $repository->createQueryBuilder('pg')
                        ->where('pg.event = :eid')
                        ->setParameter('eid', $eventId)
                        ->orderBy('pg.innerOrder', 'ASC'); 
                },
                'choice_label' => 'name',
                'required' => false,
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