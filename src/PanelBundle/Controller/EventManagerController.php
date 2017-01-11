<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use PanelBundle\Form\AddEventForm;

class EventManagerController extends Controller {
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
            
            $Recorder = $this->get('invitation.recorder')->start('event.create');
            $Recorder
                ->record('event.urlName', $Event->getUrlName())
                ->record('event.name', $Event->getName())
                ->record('event.eventType', $Event->getEventType()->getName())
                ->record('event.description', $Event->getDescription())
                ->record('event.date', $Event->getDate())
                ->record('event.place', $Event->getPlace())
            ->commit();
            
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('eventManager.messages.eventAdd', ['%event%' => $Event->getName()]))
            ;
            return $this->redirectToRoute('panel_event_manager');
        }
        
        $Events = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findByRelatedUser($this->getUser());
            
        foreach($Events as $Event) {
            $Event->loadPermissionSet($this->getUser());
        }

        return $this->render('PanelBundle:EventManager:index.html.twig', array(
            'Events' => $Events,
            'form' => $form->createView(),
        ));
    }
    
    public function deleteAction(Request $request, $slug) {
        
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);

        if($Event == null) {
            $request->getSession()
                ->getFlashBag()
                ->add('danger', $this->get('translator')->trans('eventManager.messages.eventRemoveFailure.NotFound'))
            ;
            return $this->redirectToRoute('panel_event_manager');
        }
        
        if($Event->checkPermission('event.remove')) {
            $request->getSession()
                ->getFlashBag()
                ->add('danger', $this->get('translator')->trans('eventManager.messages.eventRemoveFailure.PermissionDeined'))
            ;
            return $this->redirectToRoute('panel_event_manager');
        }
        
        $Recorder = $this->get('invitation.recorder')->start('event.delete');
        $Recorder->record('event.id', $Event->getId());
        $Recorder->commit();
        
        $Event->setStatus(Event::STATUS_DELETED);
        
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($Event);
        $em->flush();
        
        $request->getSession()
            ->getFlashBag()
            ->add('success', $this->get('translator')->trans('eventManager.messages.eventRemove', ['%event%' => $Event->getName()]))
        ;
        return $this->redirectToRoute('panel_event_manager');
    }

}
