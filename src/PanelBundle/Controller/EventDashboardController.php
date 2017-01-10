<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class EventDashboardController extends Controller {
    
    public function indexAction($slug) {
        $Recorder = $this->get('invitation.recorder')->start('really.nothing');
        
        
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        $Event->loadPermissionSet($this->getUser());
        if(!$Event->checkPermission('event.view')) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $this->breadcrumb($Event);
        
        return $this->render('PanelBundle:EventDashboard:index.html.twig', array(
            'Event' => $Event,
        ));
    }
    
    protected function breadcrumb($Event) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.home", $this->get("router")->generate("panel_event_manager"));
        $breadcrumbs->addItem("literal", null, ['%var%'=>$Event->getName()]);
    }

}
