<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use PanelBundle\Entity\Form\AddInvitationForm;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class InvitationsManagerController extends Controller
{
    public function indexAction($slug)
    {
        
        $Event = $this->getDoctrine()
            ->getRepository('InvitationBundle:Event')
            ->findOneByUrlName($slug);
        $Event->loadPermissionSet($this->getUser());
        if(!$Event->checkPermission('event.invitation.view')) {
            throw new AccessDeniedException('Access denied.');
        }
        
        $AddInvitationForm = new AddInvitationForm();
        
        $Form = $this->createFormBuilder($AddInvitationForm)
            ->add('invitation', TextType::class, array('label' => 'invitationsManager.addDialog.invitation'))
            ->add('person', CollectionType::class, array(
                'entry_type'   => TextType::class,
                'label' => 'invitationsManager.addDialog.person',

                'allow_add' => true,
                'allow_delete' => true,

                'prototype' => true,
            ))->getForm();
        
        return $this->render('PanelBundle:InvitationsManager:index.html.twig', array(
            'Event' => $Event,
            'form' => $Form->createView(),
        ));
    }

}
