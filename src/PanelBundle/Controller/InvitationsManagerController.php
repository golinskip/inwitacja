<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use PanelBundle\Form\AddInvitationForm;
use PanelBundle\Entity\AddInvitation;
use InvitationBundle\Entity\Invitation;
use InvitationBundle\Entity\Person;

class InvitationsManagerController extends Controller
{
    public function indexAction(Request $request, $slug, $page) {
        
        $Event = $this->getEventBySlug($slug);
        
        $AddInvitation = new AddInvitation();
        $AddInvitation->addPerson('');
        
        $form = $this->createForm(AddInvitationForm::class, $AddInvitation);
        $Invitations = $this->getDoctrine()
            ->getRepository('InvitationBundle:Invitation')
            ->findByEvent($Event);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $Invitations,
            $page,
            20
        );
        
        $this->breadcrumb($Event);
        
        return $this->render('PanelBundle:InvitationsManager:index.html.twig', array(
            'Event' => $Event,
            'pagination' => $pagination,
            'Invitations' => $Invitations,
            'form' => $form->createView(),
        ));
    }
    
    public function addInvitationAction(Request $request, $slug) {
        
        $Event = $this->getEventBySlug($slug);
        
        $AddInvitation = new AddInvitation();
        $form = $this->createForm(AddInvitationForm::class, $AddInvitation);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $Invitation = new Invitation;
            $Invitation->setEvent($Event);
            $Invitation->setName($AddInvitation->getInvitation());
            $Invitation->setInnerOrder(0);
            $Invitation->setStatus(0);
            
            $em->persist($Invitation);
            
            $innerOrder = 0;
            foreach($AddInvitation->getPerson() as $personName) {
                if($personName === null) {
                    continue;
                }
                $Person = new Person;
                $Person->setName($personName);
                $Person->setInvitation($Invitation);
                $Person->setStatus(0);
                $Person->setInnerOrder($innerOrder);
                
                $em->persist($Person);
                
                $innerOrder++;
            }
            
            $em->flush();
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')
                    ->trans('invitationsManager.messages.addSuccess', ['%name%' => $Invitation->getName()]))
            ;
        }
        
        return $this->redirectToRoute('panel_invitations_manager', [
            'slug' => $slug
        ]);
    }
    
    public function removeInvitationAction(Request $request, $slug, $invitation) {
        $Event = $this->getEventBySlug($slug);
        
        $em = $this->getDoctrine()->getManager();
        
        $Invitation = $this->getDoctrine()
            ->getRepository('InvitationBundle:Invitation')
            ->findOneById($invitation);
        
        if($Invitation->getEvent() != $Event) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $name = $Invitation->getName();
            
        if (!$Invitation) {
            throw $this->createNotFoundException('Invitation not found');
        }

        $em->remove($Invitation);
        $em->flush();
        
        
        $request->getSession()
            ->getFlashBag()
            ->add('success', $this->get('translator')
                ->trans('invitationsManager.messages.removeSuccess', ['%name%' => $name]))
        ;
        
        return $this->redirectToRoute('panel_invitations_manager', [
            'slug' => $slug
        ]);
    }
    
    protected function getEventBySlug($slug) {
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        if(!$Event) {
            throw $this->createNotFoundException('Event not found');
        }
        $Event->loadPermissionSet($this->getUser());
        if(!$Event->checkPermission('event.invitation.view')) {
            throw new AccessDeniedException('Access denied.');
        }
        return $Event;
    }
    
    protected function breadcrumb($Event) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.home", $this->get("router")->generate("panel_event_manager"));
        $breadcrumbs->addItem("literal", $this->get("router")->generate("panel_event_dashboard", array(
            'slug' => $Event->getUrlName(),
        )), ['%var%'=>$Event->getName()]);
        $breadcrumbs->addItem("breadcrumb.invitation.list");
    }

}
