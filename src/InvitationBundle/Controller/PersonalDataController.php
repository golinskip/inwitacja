<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Form\PersonalDataForm;
use Symfony\Component\HttpFoundation\Request;

class PersonalDataController extends Controller {
    
    public function indexAction(Request $request, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $Invitation = $this->getUser();
        
        $Event = $Invitation->getEvent();
        
        $form = $this->createForm(PersonalDataForm::class, $Invitation);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($Invitation);
            $em->flush();
            
            $Recorder = $this->get('invitation.recorder')->start('invitation.edit')
                ->record('invitation.phone', $Invitation->getPhone())
                ->record('invitation.email', $Invitation->getEmail())
            ->commit();
            
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('personalData.messages.success'))
            ;
        
            return $this->redirectToRoute('invitation_personal_data', [
                'slug' => $slug,
            ]);
        }
        
        $this->breadcrumb($Event);
        
        return $this->render('InvitationBundle:PersonalData:index.html.twig', array(
            'Invitation' => $Invitation,
            'form' => $form->createView(),
        ));
    }
    
    
    protected function breadcrumb($Event) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.home", $this->get("router")->generate("invitation_dashboard", [
            'slug' => $Event->getUrlName(),
        ]));
        $breadcrumbs->addItem("breadcrumb.personalData");
    }

}
