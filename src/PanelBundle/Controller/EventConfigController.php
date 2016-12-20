<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PanelBundle\Form\EventConfigForm;
use Symfony\Component\HttpFoundation\Response;
use InvitationBundle\Entity\Parameter;

class EventConfigController extends Controller {
    
    const OUTPUT_HTML = 'html';
    const OUTPUT_VALUE = 'value';
    
    public function indexAction(Request $request, $slug) {
        $Event = $this->getEvent($slug);
        
        $form = $this->createForm(EventConfigForm::class, $Event, ['attr' => ['locale' => $request->getLocale()]]);
        
        $this->breadcrumb($Event);
        
        return $this->render('PanelBundle:EventConfig:index.html.twig', array(
            'Event' => $Event,
            'form' => $form->createView(),
        ));
    }
    
    public function saveAction(Request $request, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $Event = $this->getEvent($slug);
        
        $form = $this->createForm(EventConfigForm::class, $Event, ['attr' => ['locale' => $request->getLocale()]]);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $Event = $form->getData();
            
            foreach($Event->getInvitationGroup() as $InvitationGroup){
                $InvitationGroup->setEvent($Event);
            }
                
            foreach($Event->getParameter() as $Parameter){
                $Parameter->setEvent($Event);
            }
                
            foreach($Event->getPersonGroup() as $PersonGroup){
                $PersonGroup->setEvent($Event);
            }
            
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
    
    public function typeConfigAction(Request $request, $type, $output) {
        
        if(!in_array ( $type , Parameter::$typeList )) {
            throw $this->createNotFoundException('Type not exists');
        }
        $typeClass = 'InvitationBundle\\Entity\\ParameterType\\'.ucfirst ( $type );
        $formClass = 'PanelBundle\\Form\\TypeConfig\\'.ucfirst ( $type ).'Form';
        $TypeObject = new $typeClass;
        $form = $this->createForm($formClass, $TypeObject);
        
        $data = [
            'type' => $type,
        ];
        
        if($output == self::OUTPUT_HTML) {
            $data[self::OUTPUT_HTML] = $this->renderView("PanelBundle:EventConfig:typeConfig/$type.html.twig", [
                'form' => $form->createView(),
            ]);
        }
        
        if($output == self::OUTPUT_VALUE) {
            $form->handleRequest($request);
            /*if ($form->isSubmitted() && $form->isValid()) {
                $TypeClass = $form->getData();*/
                //$data[self::OUTPUT_VALUE] = serialize($TypeClass);
                //$data[self::OUTPUT_VALUE] = $_POST;
            //}
        }

        $response = new Response(json_encode($data));
        return $response;
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
