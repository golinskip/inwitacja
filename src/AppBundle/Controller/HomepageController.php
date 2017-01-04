<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller {
    public function indexAction() {
        $registrationFormFactory = $this->get('fos_user.registration.form.factory');
        
        $formLogin = null;
        $formRegistration = $registrationFormFactory->createForm();
        
        return $this->render('AppBundle:Homepage:index.html.twig', array(
            'formRegistration' => $formRegistration->createView(),
            'formLogin' => $formLogin,
        ));
    }

}
