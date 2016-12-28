<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('InvitationBundle:Dashboard:index.html.twig', array(
            // ...
        ));
    }

}
