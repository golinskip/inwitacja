<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InvitationEditorController extends Controller
{
    public function indexAction(Request $request, $slug, $invitation) {
        return $this->render('PanelBundle:InvitationEditor:index.html.twig', array(
            // ...
        ));
    }

}
