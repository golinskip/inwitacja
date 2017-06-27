<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InvitationBundle\Entity\News;

class DashboardController extends Controller {
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $Invitation = $this->getUser();
        
        $Event = $Invitation->getEvent();
        
        $NewsCollection = $em->createQuery(
                'SELECT n FROM InvitationBundle:News n
                LEFT JOIN n.invitations ni
                WHERE 
                ((n.event = :Event AND n.range = '.News::RANGE_EVENT.') OR
                (ni = :Invitation AND n.range = '.News::RANGE_INVITATION.')) AND
                n.published = 1 AND
                n.publishAt < CURRENT_TIMESTAMP()
                ORDER BY n.createdAt DESC'
            )
            ->setParameter('Event', $Event)
            ->setParameter('Invitation', $Invitation)
            ->getResult();
        return $this->render('InvitationBundle:Dashboard:index.html.twig', array(
            'Invitation' => $Invitation,
            'Event' => $Event,
            'NewsCollection' => $NewsCollection,
        ));
    }
}
