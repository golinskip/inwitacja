<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use InvitationBundle\Form\LoginForm;

class DefaultController extends Controller
{
    public function indexAction($slug) {
        $Event = $this->getEvent($slug);
        
        $form = $this->createForm(LoginForm::class);
        
        return $this->render('InvitationBundle:Default:index.html.twig', [
            'Event' => $Event,
            'form' => $form->createView(),
        ]);
    }
    
    public function authenticateAction(Request $request, $slug) {
        $Event = $this->getEvent($slug);
        
        $form = $this->createForm(LoginForm::class);
        
        $form->handleRequest($request);
        $code = $form->getData()['code'];
        
        $Invitation = $this->getDoctrine()
            ->getRepository('InvitationBundle:Invitation')
            ->findOneBy([
                'event' => $Event,
                'code' => $code,
            ])
            ;
        
    }
    
    /**
     * 
     * @param string $slug
     * @return InvitationBundle\Entity\Event
     * @throws AccessDeniedException
     */
    protected function getEvent($slug) {
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        if($Event == null) {
            throw $this->createNotFoundException('The Event not exists');
        }
        return $Event;
    }
}
