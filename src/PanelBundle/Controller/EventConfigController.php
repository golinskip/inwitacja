<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PanelBundle\Form\EventConfigForm;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
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
        
        $originalInvitationGroups = new ArrayCollection();
        $originalPersonGroup = new ArrayCollection();
        $originalParameter = new ArrayCollection();

        foreach ($Event->getInvitationGroup() as $InvitationGroup) {
            $originalInvitationGroups->add($InvitationGroup);
        }
        
        foreach ($Event->getPersonGroup() as $PersonGroup) {
            $originalPersonGroup->add($PersonGroup);
        }
        
        foreach ($Event->getParameter() as $Parameter) {
            $originalParameter->add($Parameter);
        }
        
        $form = $this->createForm(EventConfigForm::class, $Event, ['attr' => ['locale' => $request->getLocale()]]);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $Event = $form->getData();
            
            foreach ($originalInvitationGroups as $InvitationGroup) {
                if (false === $Event->getInvitationGroup()->contains($InvitationGroup)) {
                    $Invitations = $InvitationGroup->getInvitation();
                    foreach($Invitations as $Invitation) {
                        $Invitation->setInvitationGroup( null );
                        $em->persist($Invitation);
                    }
                    $Event->getInvitationGroup()->removeElement($InvitationGroup);
                    $em->persist($Event);
                    $em->remove($InvitationGroup);
                }
            }
            
            foreach ($originalPersonGroup as $PersonGroup) {
                if (false === $Event->getPersonGroup()->contains($PersonGroup)) {
                    $People = $PersonGroup->getPerson();
                    foreach($People as $Person) {
                        $Person->setPersonGroup( null );
                        $em->persist($Person);
                    }
                    $Event->getPersonGroup()->removeElement($PersonGroup);
                    $em->persist($Event);
                    $em->remove($PersonGroup);
                }
            }
            
            foreach ($originalParameter as $Parameter) {
                if (false === $Event->getParameter()->contains($Parameter)) {
                    $Event->getParameter()->removeElement($Parameter);
                    $em->persist($Event);
                    $em->remove($Parameter);
                }
            }
            
            foreach($Event->getInvitationGroup() as $InvitationGroup){
                $InvitationGroup->setEvent($Event);
            }
                
            foreach($Event->getPersonGroup() as $PersonGroup){
                $PersonGroup->setEvent($Event);
            }
                
            foreach($Event->getParameter() as $Parameter){
                $Parameter->setEvent($Event);
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
        $data = $request->request->get('data');
        if($data !== null && strlen($data) > 0) {
            $TypeObject = @unserialize(base64_decode($data));
            if($TypeObject == false || get_class($TypeObject) !== $typeClass) {
                $TypeObject = new $typeClass;
            }
        } else {
            $TypeObject = new $typeClass;
        }
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
            if ($form->isSubmitted() && $form->isValid()) {
                $TypeClass = $form->getData();
                $data[self::OUTPUT_VALUE] = base64_encode(serialize($TypeClass));
            }
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
