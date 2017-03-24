<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $meetup = $this->get('website.services.meetup');
        dump($meetup->nextEvent());

        return $this->render('WebsiteBundle:Default:index.html.twig');
    }
}
