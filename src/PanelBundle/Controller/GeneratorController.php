<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GeneratorController extends Controller
{
    public function indexAction($slug) {
        $Event = $this->getEvent($slug);
        
        $this->breadcrumb($Event);
        
        return $this->render('PanelBundle:Generator:index.html.twig', array(
            'Event' => $Event,
        ));
    }
    
    public function generateStickersAction($slug) {
        $Event = $this->getEvent($slug);
        
        $html = $this->renderView('PanelBundle:Generator:PDF/stickers.html.twig', array(
            'Event' => $Event,
        ));
        
        $pdfGenerator = $this->get('knp_snappy.pdf');

        $filename = $this->get('translator')->trans('generator.stickers.filename');
        
        return new Response($pdfGenerator->getOutputFromHtml($html), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"'
        ]
        );
    }
    
    protected function getEvent($slug) {
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        $Event->loadPermissionSet($this->getUser());
        if(!$Event->checkPermission('event.view')) {
            throw new AccessDeniedException('Access denied.');
        }
        return $Event;
    }

    protected function breadcrumb($Event) {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("breadcrumb.home", $this->get("router")->generate("panel_event_manager"));
        $breadcrumbs->addItem("literal", $this->get("router")->generate("panel_event_dashboard", array(
                    'slug' => $Event->getUrlName(),
                )), ['%var%' => $Event->getName()]);
        $breadcrumbs->addItem("breadcrumb.event.generator");
    }

}
