<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use PanelBundle\Form\AddEventForm;

class EventManagerController extends Controller
{
    public function indexAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        
        $Event = new Event;
        $Event->setDate(new \DateTime('tomorrow'));
        
        $form = $this->createForm(AddEventForm::class, $Event, ['attr' => ['locale' => $request->getLocale()]]);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $Event = $form->getData();
            $Event->setCreatedBy($this->getUser());
            $em->persist($Event);
            $em->flush();
            return $this->redirectToRoute('panel_event_manager');
        }
        
        $Events = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findByRelatedUser($this->getUser());
            
        $actionTab = [];
        foreach($Events as $Event) {
            $Event->loadPermissionSet($this->getUser());
        }

        return $this->render('PanelBundle:EventManager:index.html.twig', array(
            'Events' => $Events,
            'form' => $form->createView(),
        ));
    }

}
