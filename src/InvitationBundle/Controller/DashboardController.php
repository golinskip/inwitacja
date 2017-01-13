<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller {
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $Invitation = $this->getUser();
        
        $Event = $Invitation->getEvent();
        
        $NewsCollection = $em->createQuery(
                'SELECT n FROM InvitationBundle:News n WHERE 
                n.event = :Event AND 
                n.published = 1 AND
                n.publishAt < CURRENT_TIMESTAMP()
                ORDER BY n.createdAt DESC'
            )
            ->setParameter('Event', $Event)
            ->getResult();
        return $this->render('InvitationBundle:Dashboard:index.html.twig', array(
            'Invitation' => $Invitation,
            'Event' => $Event,
            'NewsCollection' => $NewsCollection,
        ));
    }
}
