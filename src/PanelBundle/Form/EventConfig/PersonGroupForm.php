<?php
namespace PanelBundle\Form\EventConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvitationBundle\Entity\PersonGroup;

class PersonGroupForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'eventConfig.form.personGroup.name',
                'attr' => [
                    'placeholder' => 'eventConfig.form.personGroup.name',
                ],
            ])
            ->add('price', NumberType::class, [
                'label' => 'eventConfig.form.personGroup.price',
                'scale' => 2,
                'attr' => [
                    'placeholder' => 'eventConfig.form.personGroup.price',
                ],
            ])
            /*->add('color', TextType::class, [
                'label' => 'eventConfig.form.personGroup.color',
                'attr' => [
                    'placeholder' => 'eventConfig.form.personGroup.color',
                ],
            ])*/
            ->add('innerOrder', HiddenType::class)
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => PersonGroup::class,
        ]);
    }
}