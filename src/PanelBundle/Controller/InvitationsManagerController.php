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
        
        return $this->render('PanelBundle:InvitationsManager:index.html.twig', array(
            'Event' => $Event,
            'pagination' => $pagination,
            'Invitations' => $Invitations,
            'form' => $form->createView(),
        ));
    }
    
    public function addInvitationAction(Request $request, $slug) {
        
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
            $em->flush();
            
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
                $em->flush();
                
                $innerOrder++;
            }
            
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('invitationsManager.messages.addSuccess'))
            ;
        }
        
        return $this->redirectToRoute('panel_invitations_manager', [
            'slug' => $slug
        ]);
    }

}
