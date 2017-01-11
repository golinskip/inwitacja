<?php

namespace InvitationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
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
    
    public function logoutAction(Request $request, $slug) {
        $this->get('security.token_storage')->setToken(null);
        $this->get('request')->getSession()->invalidate();
        
        return $this->redirectToRoute('invitation_homepage', [
            'slug' => $slug,
        ]);
    }
    
    public function authenticateBySUTAction(Request $request, $slug, $singleUseToken) {
        $Event = $this->getEvent($slug);
        
        $Invitation = $this->getDoctrine()
            ->getRepository('InvitationBundle:Invitation')
            ->findOneBy([
                'event' => $Event,
                'singleUseToken' => $singleUseToken,
            ])
            ;
        if (!$Invitation) {
            $request->getSession()
                ->getFlashBag()
                ->add('warning', $this->get('translator')->trans('loginPanel.messages.invalidCode'))
            ;
            throw new UsernameNotFoundException("User not found");
        } else {
            $token = new UsernamePasswordToken($Invitation, null, "invitation", $Invitation->getRoles());
            $this->get("security.token_storage")->setToken($token); //now the user is logged in

            $Recorder = $this->get('invitation.recorder')->start('login.singleUseToken')->commit();
            
            //now dispatch the login event
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            
            // Regenerate new token
            $Invitation->generateSingleUseToken();
            $em = $this->getDoctrine()->getManager();
            $em->persist($Invitation);
            $em->flush();
        }
        
        
        return $this->redirectToRoute('invitation_dashboard', [
            'slug' => $Event->getUrlName(),
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
        
        if (!$Invitation) {
            $request->getSession()
                ->getFlashBag()
                ->add('warning', $this->get('translator')->trans('loginPanel.messages.invalidCode'))
            ;
            throw new UsernameNotFoundException("User not found");
        } else {
            $token = new UsernamePasswordToken($Invitation, null, "invitation", $Invitation->getRoles());
            $this->get("security.token_storage")->setToken($token); //now the user is logged in

            $Recorder = $this->get('invitation.recorder')->start('login.code')->commit();
            
            //now dispatch the login event
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
        }
        
        return $this->redirectToRoute('invitation_dashboard', [
            'slug' => $Event->getUrlName(),
        ]);
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
