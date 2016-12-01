<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PanelBundle\Form\EditInvitationForm;

class InvitationEditorController extends Controller
{
    public function indexAction(Request $request, $slug, $invitation) {
        
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        if(!$Event) {
            throw $this->createNotFoundException('Event not found');
        }
        $Event->loadPermissionSet($this->getUser());
        if(!$Event->checkPermission('event.invitation.edit')) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $Invitation = $this->getDoctrine()
            ->getRepository('InvitationBundle:Invitation')
            ->findOneById($invitation);
        
        if($Invitation === null || $Invitation->getEvent() != $Event) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $form = $this->createForm(EditInvitationForm::class, $Invitation);
        
        return $this->render('PanelBundle:InvitationEditor:index.html.twig', array(
            'Invitation' => $Invitation,
            'form' => $form->createView(),
        ));
    }

}
