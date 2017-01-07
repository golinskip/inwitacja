<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ContactForm;

class HomepageController extends Controller {
    public function indexAction() {
        $registrationFormFactory = $this->get('fos_user.registration.form.factory');
        
        $formRegistration = $registrationFormFactory->createForm();
        
        $formContact = $this->createForm(ContactForm::class);
        
        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;
        
        return $this->render('AppBundle:Homepage:index.html.twig', array(
            'formRegistration' => $formRegistration->createView(),
            'formContact' => $formContact->createView(),
            'csrf_token' => $csrfToken,
        ));
    }
    
    public function sendMessageAction(Request $request) {
        
        $form = $this->createForm(ContactForm::class);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $message = \Swift_Message::newInstance()
                ->setSubject($form->get('subject')->getData())
                ->setFrom($form->get('email')->getData())
                ->setTo($this->container->getParameter('contact_email'))
                ->setBody(
                    $this->renderView(
                        'AppBundle:Mail:contact.html.twig',
                        array(
                            'ip' => $request->getClientIp(),
                            'name' => $form->get('name')->getData(),
                            'message' => $form->get('message')->getData()
                        )
                    )
                );

            $this->get('mailer')->send($message);
            
            $request->getSession()
                ->getFlashBag()
                ->add('success', $this->get('translator')->trans('contact.messages.success'))
            ;
        }
        return $this->redirectToRoute('index');
    }

}
