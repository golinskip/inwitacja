<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller
{
    public function personAction()
    {
        return $this->render('PanelBundle:Report:person.html.twig', array(
            // ...
        ));
    }

    public function invitationAction()
    {
        return $this->render('PanelBundle:Report:invitation.html.twig', array(
            // ...
        ));
    }

    public function changelogAction()
    {
        return $this->render('PanelBundle:Report:changelog.html.twig', array(
            // ...
        ));
    }

}
