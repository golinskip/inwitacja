<?php
namespace PanelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use InvitationBundle\Entity\News;

class NewsForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title', TextType::class, array('label' => 'news.create.form.title'))
            ->add('urlName', TextType::class, array('label' => 'news.create.form.urlName'))
            ->add('published', CheckboxType::class, array(
                'required' => false,
                'label' => 'news.create.form.published',
             ))
            ->add('publishAt', DateTimeType::class, array('label' => 'news.create.form.publishAt'))
            ->add('shortContent', CKEditorType::class, array('label' => 'news.create.form.shortContent'))
            ->add('content', CKEditorType::class, array('label' => 'news.create.form.content'))
            ->add('submit', SubmitType::class, array('label' => 'news.create.form.submit'))
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}