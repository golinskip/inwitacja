<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InvitationsManagerController extends Controller
{
    public function indexAction($slug)
    {
        return $this->render('PanelBundle:InvitationsManager:index.html.twig', array(
            // ...
        ));
    }

}
