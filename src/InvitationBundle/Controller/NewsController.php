<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction($newsSlug) {
        $Invitation = $this->getUser();
        $Event = $Invitation->getEvent();
        
        $News = $this->getDoctrine()
            ->getRepository('InvitationBundle:News')
            ->findOneBy([
                'urlName' => $newsSlug,
                'event' => $Event,
            ]);
            
        if($News == null || $News->getEvent() !== $Event) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $NewsCollection = $em->createQuery(
                'SELECT n FROM InvitationBundle:News n WHERE 
                n.event = :Event AND 
                n.published = 1 AND
                n.publishAt < CURRENT_TIMESTAMP()
                ORDER BY n.createdAt DESC'
            )
            ->setParameter('Event', $Event)
            ->getResult();
        
        $this->breadcrumb($News, $Event);
        
        return $this->render('InvitationBundle:News:index.html.twig', array(
            'Invitation' => $Invitation,
            'Event' => $Event,
            'News' => $News,
            'NewsCollection' => $NewsCollection,
        ));
    }
    
    protected function breadcrumb($News, $Event) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.home", $this->get("router")->generate("invitation_dashboard", [
            'slug' => $Event->getUrlName(),
        ]));
        $breadcrumbs->addItem("literal", [], ['%var%' => $News->getTitle()]);
    }

}
