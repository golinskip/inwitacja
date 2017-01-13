<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use PanelBundle\Form\Generators\StickersForm;
use PanelBundle\Form\Generators\VignetteForm;

class GeneratorController extends Controller
{
    public function indexAction($slug) {
        $Event = $this->getEvent($slug);
        
        $forms = [
            'stickers' => $this->createForm(StickersForm::class)->createView(),
            'vignette' => $this->createForm(VignetteForm::class)->createView(),
        ];
        
        $this->breadcrumb($Event);
        
        return $this->render('PanelBundle:Generator:index.html.twig', array(
            'Event' => $Event,
            'forms' => $forms,
        ));
    }
    
    public function generateVignetteAction(Request $request, $slug) {
        $Event = $this->getEvent($slug);
        
        $form = $this->createForm(VignetteForm::class);
        
        $form->handleRequest($request);
        
        $html = $this->renderView('PanelBundle:Generator:PDF/vignette.html.twig', array(
            'Event' => $Event,
            'data' => $form->getData(),
        ));
        
        $pdfGenerator = $this->get('knp_snappy.pdf');

        $filename = $this->get('translator')->trans('generator.vignette.filename');
        
        return new Response($pdfGenerator->getOutputFromHtml($html), 200, [
            'Content-Type' => 'application/pdf',
            //@todo: odkomentować
            //'Content-Disposition' => 'attachment; filename="'.$filename.'.pdf"',
            'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"',
        ]
        );
    }
    
    public function generateStickersAction(Request $request, $slug) {
        $Event = $this->getEvent($slug);
        
        $form = $this->createForm(StickersForm::class);
        
        $form->handleRequest($request);
        
        $html = $this->renderView('PanelBundle:Generator:PDF/stickers.html.twig', array(
            'Event' => $Event,
            'data' => $form->getData(),
        ));
        
        $pdfGenerator = $this->get('knp_snappy.pdf');

        $filename = $this->get('translator')->trans('generator.stickers.filename');
        
        return new Response($pdfGenerator->getOutputFromHtml($html), 200, [
            'Content-Type' => 'application/pdf',
            //@todo: odkomentować
            //'Content-Disposition' => 'attachment; filename="'.$filename.'.pdf"',
            'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"',
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
        $breadcrumbs->addItem("breadcrumb.eventManager", $this->get("router")->generate("panel_event_manager"));
        $breadcrumbs->addItem("literal", $this->get("router")->generate("panel_event_dashboard", array(
                    'slug' => $Event->getUrlName(),
                )), ['%var%' => $Event->getName()]);
        $breadcrumbs->addItem("breadcrumb.event.generator");
    }

}
