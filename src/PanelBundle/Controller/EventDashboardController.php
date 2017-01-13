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
        
        $this->breadcrumb($Event);
        
        return $this->render('PanelBundle:EventDashboard:index.html.twig', array(
            'Event' => $Event,
            'Changelog' => $this->getLastChangelogs($Event),
            'PersonStats' => $this->getPersonStats($Event),
        ));
    }
    
    protected function getLastChangelogs($Event) {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT cl, i FROM InvitationBundle\Entity\Changelog cl JOIN cl.invitation i WHERE i.event = :Event ORDER BY cl.date DESC")->setMaxResults(10);
        $query->setParameter('Event', $Event);
        $res = $query->getResult();
        return $res;
    }
    
    protected function getPersonStats($Event) {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT p.status, count(p) as numOf FROM InvitationBundle\Entity\Person p JOIN p.invitation i WHERE i.event = :Event GROUP BY p.status");
        $query->setParameter('Event', $Event);
        $resultArr = [
            0 => 0,
            1 => 0,
            2 => 0,
            'sum' => 0,
        ];
        foreach($query->getResult() as $row) {
            $resultArr[$row['status']] += (int)$row['numOf'];
            $resultArr['sum'] += (int)$row['numOf'];
        }
        return $resultArr;
    }
    
    protected function breadcrumb($Event) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.eventManager", $this->get("router")->generate("panel_event_manager"));
        $breadcrumbs->addItem("literal", null, ['%var%'=>$Event->getName()]);
    }

}
