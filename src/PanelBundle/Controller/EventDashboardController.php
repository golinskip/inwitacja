<?php

namespace PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventDashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('PanelBundle:EventDashboard:index.html.twig', array(
            // ...
        ));
    }

}
