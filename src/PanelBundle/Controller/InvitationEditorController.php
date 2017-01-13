<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use PanelBundle\Form\EditInvitationForm;

class InvitationEditorController extends Controller
{
    public function indexAction(Request $request, $slug, $invitation) {
        $em = $this->getDoctrine()->getManager();
        
        $Event = $this->loadEvent($slug);
        if(!$Event->checkPermission('event.invitation.edit')) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $Invitation = $this->loadInvitation($invitation, $Event);
        
        $originalPerson = new ArrayCollection();

        foreach ($Invitation->getPerson() as $Person) {
            $originalPerson->add($Person);
        }
        
        $form = $this->createForm(EditInvitationForm::class, $Invitation, ['attr' => ['eventId' => $Event->getId()]]);
        
        $form->handleRequest($request);
        
        $this->breadcrumb($Event, $Invitation);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $Invitation = $form->getData();
            
            $Recorder = $this->get('invitation.recorder')->start('invitation.update');
            $Recorder
                ->record('invitation.id', $Invitation->getId())
                ->record('invitation.name', $Invitation->getName())
                ->record('invitation.phone', $Invitation->getPhone())
                ->record('invitation.email', $Invitation->getEmail())
                ->record('invitation.group', $Invitation->getInvitationGroup()->getName());
            
            foreach ($originalPerson as $Person) {
                if (false === $Invitation->getPerson()->contains($Person)) {
                    $Invitation->getPerson()->removeElement($Person);
                    $em->persist($Invitation);
                    $em->remove($Person);
                }
            }
            foreach($Invitation->getPerson() as $Person) {
                $Person->setInvitation($Invitation);
                $Recorder->record('person.name', $Person->getName());
            }
            
            $em->persist($Invitation);
            $em->flush();
            
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('invitationEditor.messages.editSuccess'))
            ;
            
            $Recorder->commit();
            
            return $this->redirectToRoute('panel_invitations_manager_invitation', [
                'slug' => $slug,
                'invitation' => $invitation,
            ]);
        }
        
        return $this->render('PanelBundle:InvitationEditor:index.html.twig', array(
            'Invitation' => $Invitation,
            'Event' => $Event,
            'form' => $form->createView(),
        ));
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
    
    protected function breadcrumb($Event, $Invitation) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.eventManager", $this->get("router")->generate("panel_event_manager"));
        $breadcrumbs->addItem("literal", $this->get("router")->generate("panel_event_dashboard", array(
            'slug' => $Event->getUrlName(),
        )), ['%var%'=>$Event->getName()]);
        $breadcrumbs->addItem("breadcrumb.invitation.list", $this->get("router")->generate("panel_invitations_manager", array(
            'slug' => $Event->getUrlName(),
        )));
        $breadcrumbs->addItem("literal", null, ['%var%'=>$Invitation->getName()]);
    }

}
