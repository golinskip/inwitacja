<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EventManagerController extends Controller
{
    public function indexAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        
        $Event = new Event;
        $Event->setDate(new \DateTime('tomorrow'));
        
        $addForm = $this->createFormBuilder($Event)
            ->add('name', TextType::class, array('label' => 'eventManager.addDialog.name'))
            ->add('eventType', EntityType::class, array('label' => 'eventManager.addDialog.type', 'class' => 'InvitationBundle:EventType', 'choice_label' => 'title'))
            ->add('description', TextType::class, array('label' => 'eventManager.addDialog.description', 'required' => false))
            ->add('date', DateType::class, array('label' => 'eventManager.addDialog.date'))
            ->add('place', TextType::class, array('label' => 'eventManager.addDialog.place', 'required' => false))
            ->getForm();
        
        $addForm->handleRequest($request);
        
        if ($addForm->isSubmitted() && $addForm->isValid()) {
            $Event = $addForm->getData();
            $Event->setCreatedBy($this->getUser());
            $em->persist($Event);
            $em->flush();
            return $this->redirectToRoute('panel_event_manager');
        }
        
        /*$Events = $em->createQueryBuilder()
            ->select('r')
            ->from('InvitationBundle:Events', 'e')
            ->innerJoin()*/
        
            
        return $this->render('PanelBundle:EventManager:index.html.twig', array(
            'addForm' => $addForm->createView(),
        ));
    }

}
