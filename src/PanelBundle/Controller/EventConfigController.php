<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PanelBundle\Form\EventConfigForm;

class EventConfigController extends Controller
{
    public function indexAction($slug) {
        $Event = $this->getEvent($slug);
        
        $form = $this->createForm(EventConfigForm::class, $Event);
        
        $this->breadcrumb($Event);
        
        return $this->render('PanelBundle:EventConfig:index.html.twig', array(
            'Event' => $Event,
            'form' => $form->createView(),
        ));
    }
    
    public function saveAction(Request $request, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $Event = $this->getEvent($slug);
        
        $form = $this->createForm(EventConfigForm::class, $Event);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $Event = $form->getData();
            
            $em->persist($Event);
            $em->flush();
            
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('invitationEditor.messages.editSuccess'))
            ;
        }
        
        return $this->redirectToRoute('panel_event_config', [
            'slug' => $slug,
        ]);
    }
    
    protected function getEvent($slug) {
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        $Event->loadPermissionSet($this->getUser());
        if(!$Event->checkPermission('event.edit')) {
            throw new AccessDeniedException('Access denied.');
        }
        return $Event;
    }
    
    protected function breadcrumb($Event) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.home", $this->get("router")->generate("panel_event_manager"));
        $breadcrumbs->addItem("literal", $this->get("router")->generate("panel_event_dashboard", array(
            'slug' => $Event->getUrlName(),
        )), ['%var%'=>$Event->getName()]);
        $breadcrumbs->addItem("breadcrumb.event.config");
    }

}
