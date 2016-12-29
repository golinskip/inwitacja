<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Form\ConfirmatorForm;
use Symfony\Component\HttpFoundation\Request;

class ConfirmatorController extends Controller
{
    public function indexAction() {
        
        $Invitation = $this->getUser();
        
        $form = $this->createForm(ConfirmatorForm::class, $Invitation);
        
        return $this->render('InvitationBundle:Confirmator:index.html.twig', array(
            'Invitation' => $Invitation,
            'form' => $form->createView(),
        ));
    }

}
