<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class EventDashboardController extends Controller {
    
    public function indexAction($slug) {
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        $Event->loadPermissionSet($this->getUser());
        if(!$Event->checkPermission('event.view')) {
            throw new AccessDeniedException('Access denied.');
        }
        
        return $this->render('PanelBundle:EventDashboard:index.html.twig', array(
            'Event' => $Event,
        ));
    }

}
