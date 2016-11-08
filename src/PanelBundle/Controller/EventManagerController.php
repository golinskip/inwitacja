<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventManagerController extends Controller
{
    public function indexAction()
    {
        $Event = new Event;
        $Event->setDate(new \DateTime('tomorrow'));
        
        $addForm = $this->createFormBuilder($Event)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('place', TextType::class)
            ->add('date', DateType::class)
            ->add('save', SubmitType::class)
            ->getForm();
        return $this->render('PanelBundle:EventManager:index.html.twig', array(
            'addForm' => $addForm->createView(),
        ));
    }

}
