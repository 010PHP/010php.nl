<?php

namespace OhTenPHP\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('OhTenPHPWebsiteBundle:Home:index.html.twig', [
            'meetup' => $this->get('oh_ten_php_website.service.meetup_service')->getNextEvent(),
            'rsvpList' => $this->get('oh_ten_php_website.service.meetup_service')->getRsvpListForNextEvent(),
        ]);

    }
}
