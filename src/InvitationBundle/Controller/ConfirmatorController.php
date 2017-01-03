<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Form\ConfirmatorForm;
use Symfony\Component\HttpFoundation\Request;
use InvitationBundle\Entity\ParameterValue;

class ConfirmatorController extends Controller
{
    public function indexAction(Request $request, $slug) {
        
        $Invitation = $this->getUser();
        
        $Parameters = $Invitation->getEvent()->getParameter();
        
        foreach($Invitation->getPerson() as $Person) {
            foreach($Invitation->getEvent()->getParameter() as $Parameter) {
                $ParameterValue = new ParameterValue;
                $ParameterValue->setParameter($Parameter);
                $ParameterValue->setPerson($Person);
                $ParameterValue->setValue(null);
                $Person->addParameterValue($ParameterValue);
            }
        }
        
        $form = $this->createForm(ConfirmatorForm::class, $Invitation);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $Invitation = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($Invitation);
            $em->flush();

            return $this->redirectToRoute('invitation_confirmator', ['slug' => $slug]);
        }
        
        return $this->render('InvitationBundle:Confirmator:index.html.twig', array(
            'Invitation' => $Invitation,
            'Parameters' => $Parameters,
            'form' => $form->createView(),
        ));
    }

}
