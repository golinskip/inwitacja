<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PanelBundle\Form\EditInvitationForm;

class InvitationEditorController extends Controller
{
    public function indexAction(Request $request, $slug, $invitation) {
        $Event = $this->loadEvent($slug);
        if(!$Event->checkPermission('event.invitation.edit')) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $Invitation = $this->loadInvitation($invitation, $Event);
        
        $form = $this->createForm(EditInvitationForm::class, $Invitation);
        
        return $this->render('PanelBundle:InvitationEditor:index.html.twig', array(
            'Invitation' => $Invitation,
            'form' => $form->createView(),
        ));
    }
    
    public function editInvitationAction(Request $request, $slug, $invitation) {
        $em = $this->getDoctrine()->getManager();
        
        $Event = $this->loadEvent($slug);
        if(!$Event->checkPermission('event.invitation.edit')) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $Invitation = $this->loadInvitation($invitation, $Event);
        
        $form = $this->createForm(EditInvitationForm::class, $Invitation);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $Invitation = $form->getData();
            $em->persist($Invitation);
            $em->flush();
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('invitationEditor.messages.editSuccess'))
            ;
        }
        
        return $this->redirectToRoute('panel_invitations_manager_invitation', [
            'slug' => $slug,
            'invitation' => $invitation,
        ]);
    }
    
    protected function loadEvent($slug) {
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        if(!$Event) {
            throw $this->createNotFoundException('Event not found');
        }
        $Event->loadPermissionSet($this->getUser());
        return $Event;
    }
    
    protected function loadInvitation($invitation, $Event){
        $Invitation = $this->getDoctrine()
            ->getRepository('InvitationBundle:Invitation')
            ->findOneById($invitation);
        
        if($Invitation === null || $Invitation->getEvent() != $Event) {
            throw new AccessDeniedException('Access denied.');
        }
        return $Invitation;
    }

}
