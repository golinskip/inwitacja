<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PersonManagerController extends Controller
{
    public function indexAction()
    {
        return $this->render('PanelBundle:PersonManager:index.html.twig', array(
            // ...
        ));
    }

}
