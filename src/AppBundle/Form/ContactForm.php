<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ContactForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'contact.name',
                'attr' => array(
                    'placeholder' => 'contact.placeholder.name',
                    'pattern'     => '.{2,}' //minlength
                )
            ))
            ->add('email', EmailType::class, array(
                'label' => 'contact.email',
                'attr' => array(
                    'placeholder' => 'contact.placeholder.email',
                )
            ))
            ->add('subject', TextType::class, array(
                'label' => 'contact.subject',
                'attr' => array(
                    'placeholder' => 'contact.placeholder.subject',
                    'pattern'     => '.{3,}' //minlength
                )
            ))
            ->add('message', TextareaType::class, array(
                'label' => 'contact.message',
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => 'contact.placeholder.message',
                )
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'contact.submit',
            ));
    }
}