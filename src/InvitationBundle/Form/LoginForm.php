<?php
namespace InvitationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('code', NumberType::class, [
                'label' => 'loginPanel.input',
                'attr' => [
                    'placeholder' => 'loginPanel.input',
                ],
            ])
            ->add('login', SubmitType::class, [
                'label' => 'loginPanel.login'
            ])
            ;
    }
}