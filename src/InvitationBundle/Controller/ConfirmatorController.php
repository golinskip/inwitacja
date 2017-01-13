<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Form\ConfirmatorForm;
use Symfony\Component\HttpFoundation\Request;
use InvitationBundle\Entity\ParameterValue;
use InvitationBundle\Entity\Person;

class ConfirmatorController extends Controller
{
    public function indexAction(Request $request, $slug) {
        
        $Invitation = $this->getUser();
        
        $Event = $Invitation->getEvent();
        
        $Parameters = $Event->getParameter();
        
        $this->fillParameterValue($Invitation, $Parameters);
        
        $form = $this->createForm(ConfirmatorForm::class, $Invitation);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $Invitation = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($Invitation);
            $em->flush();
            
            $this->notify($Invitation);
            
            return $this->redirectToRoute('invitation_confirmator', ['slug' => $slug]);
        }
        
        $this->breadcrumb($Event);
        
        return $this->render('InvitationBundle:Confirmator:index.html.twig', array(
            'Invitation' => $Invitation,
            'Parameters' => $Parameters,
            'form' => $form->createView(),
        ));
    }
    
    protected function breadcrumb($Event) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.home", $this->get("router")->generate("invitation_dashboard", [
            'slug' => $Event->getUrlName(),
        ]));
        $breadcrumbs->addItem("breadcrumb.confirmator");
    }
    
    protected function notify($Invitation) {
        
            $Recorder = $this->get('invitation.recorder')->start('invitation.confirm');
            $Recorder->record('invitation.name', $Invitation->getName());
            $PersonI = 0;
            foreach($Invitation->getPerson() as $Person) {
                $Recorder->record('person.'.$PersonI.'.name', $Person->getName());
                $Recorder->record('person.'.$PersonI.'.status', $Person->getStatus());
                if($Person->getStatus() === Person::STATUS_PRESENT)
                foreach($Person->getParameterValue() as $ParameterValue) {
                    $ParameterArr = [
                        'name' => $ParameterValue->getParameter()->getName(),
                        'value' => $ParameterValue->getValue(),
                    ];
                    $Recorder->record('person.'.$PersonI.'.parameter', serialize($ParameterArr));
                }
                $PersonI++;
            }
            $Recorder->commit();
    }
    
    protected function fillParameterValue($Invitation, $Parameters) {
        foreach($Invitation->getPerson() as $Person) {
            $parameterSet = [];
            foreach($Person->getParameterValue() as $Parameter) {
                $parameterSet[] = $Parameter->getParameterId();
            }
            foreach($Invitation->getEvent()->getParameter() as $Parameter) {
                if(in_array($Parameter->getId(), $parameterSet)) {
                    continue;
                }
                $ParameterValue = new ParameterValue;
                $ParameterValue->setParameter($Parameter);
                $ParameterValue->setPerson($Person);
                $ParameterValue->setValue(null);
                $Person->addParameterValue($ParameterValue);
            }
        }
    }

}
