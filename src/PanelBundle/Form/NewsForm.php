<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use InvitationBundle\Entity\News;
use InvitationBundle\Entity\Invitation;

class NewsForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('published', CheckboxType::class, array(
                'required' => false,
                'label' => 'news.create.form.published',
             ))
            ->add('title', TextType::class, array('label' => 'news.create.form.title'))
            ->add('urlName', TextType::class, array('label' => 'news.create.form.urlName'))
            ->add('publishAt', DateTimeType::class, array('label' => 'news.create.form.publishAt'))
            ->add('range', ChoiceType::class, [
                'label' => 'news.create.form.range.title',
                'choices' => [
                    'news.create.form.range.event' => News::RANGE_EVENT,
                    'news.create.form.range.invitation' => News::RANGE_INVITATION,
                ],
            ])
            ->add('invitations', EntityType::class, [
                'required' => false,
                'class' => Invitation::class,
                'label' => 'news.create.form.range.invitations',
                'multiple' => true,
                'choices' => $options['Invitations'],
                'choice_label' => function($organisation, $key, $index) {
                    return $organisation->getName();
                },
            ])
            ->add('shortContent', CKEditorType::class, array(
                'config_name' => 'article',
                'label' => 'news.create.form.shortContent'
            ))
            ->add('content', CKEditorType::class, array(
                'config_name' => 'article',
                'label' => 'news.create.form.shortContent'
            ))
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => News::class,
            'Invitations' => [],
        ]);
    }
}