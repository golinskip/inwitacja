<?php
namespace InvitationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use InvitationBundle\Entity\Invitation;

class PersonalDataForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('phone', TextType::class, [
                'label' => 'personalData.phone',
                'attr' => [
                    'placeholder' => 'personalData.phone',
                ],
                'required' => false,
            ])
            ->add('email', TextType::class, [
                'label' => 'personalData.email',
                'attr' => [
                    'placeholder' => 'personalData.email',
                ],
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'personalData.submit'
            ])
            ;
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => Invitation::class,
        );
    }
}